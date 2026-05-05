<?php

namespace App\Services;

use App\Models\PropuestaActividad;
use Illuminate\Support\Collection;

class CotizacionService
{
    // Constantes de porcentajes AIU
    private const ADMINISTRACION = 0.12;
    private const IMPREVISTOS    = 0.03;
    private const UTILIDAD       = 0.04;
    private const IVA_UTILIDAD   = 0.19; // 19% aplicado SOLO sobre la utilidad

    // ─── Palabras clave para detección de categoría ────────────────────────────

    // Items de COCINA / ZONA DE ROPAS → multiplicador siempre 1
    // IMPORTANTE: evaluados PRIMERO para evitar falsos positivos
    private const KEYWORDS_COCINA = [
        'mueble alto',
        'mueble bajo',
        'barra auxiliar',
        'campana extractora',
        'estufa',
        'horno',
        'punto de gas',
        'lavaplatos',
        'meson de cocina',
        'meson barra',
        'riel spot',
        'mueble de ropas',
        'ropa',
    ];

    // Items que se multiplican por número de HABITACIONES
    private const KEYWORDS_HABITACION = [
        'closet',
    ];

    // Items que se multiplican por número de BAÑOS
    private const KEYWORDS_BANO = [
        'división de baño',
        'division de baño',
        'espejo flotado',
        'herrajes',
        'mueble flotado',
        'vidrio templado',
        'sanitario',
        'lavamanos',
        'ducha',
        'acoflex',
        'brida',
        'taza',
        'combo ecoclean',
    ];

    // Items que se multiplican por número de PUERTAS (baños + habitaciones)
    private const KEYWORDS_PUERTA = [
        'puerta',
    ];

    // ─── Descripciones que SIEMPRE tienen cantidad fija = 1 ───────────────────
    // Se usan para evitar que calcularCantidadBase detecte barra auxiliar / mueble alto
    // en items que el negocio define como fijos (ej: Quarztone barra en Experto).
    // Se compara contra la descripción exacta (lowercase).
    private const DESCRIPCIONES_CANTIDAD_FIJA = [
        'meson barra auxiliar en quarztone (hasta1.2m largo )',
        'meson barra auxiliar en quarztone (hasta 1.2 m largo)',
    ];

    /**
     * Calcula las propuestas de cotización (elemental, estándar, experto).
     */
    public function calcularPropuestas(array $datos): array
    {
        $parametros = $this->normalizarParametrosEntrada($datos);
        $resultados = [];

        foreach (['elemental', 'estandar', 'experto'] as $tipo) {
            $resultados[$tipo] = $this->calcularPropuestaIndividual($tipo, $parametros);
        }

        return $resultados;
    }

    /**
     * Normaliza y valida los parámetros de entrada.
     */
    private function normalizarParametrosEntrada(array $datos): array
    {
        return [
            'area_privada'             => max((float) ($datos['area_privada'] ?? 0), 1.0),
            'num_banos'                => max((int) ($datos['num_banos'] ?? 1), 1),
            'num_habitaciones'         => max((int) ($datos['num_habitaciones'] ?? 1), 1),
            'tiene_mueble_alto_cocina' => (bool) ($datos['tiene_mueble_alto_cocina'] ?? false),
            'tiene_barra_auxiliar'     => (bool) ($datos['tiene_barra_auxiliar'] ?? false),
        ];
    }

    /**
     * Calcula una propuesta individual para un tipo específico.
     */
    private function calcularPropuestaIndividual(string $tipo, array $parametros): array
    {
        $items   = $this->obtenerItemsPropuesta($tipo);
        $detalle = $this->procesarItems($items, $parametros);
        $subtotal = $this->calcularSubtotal($detalle);
        $totales  = $this->calcularTotalesAIU($subtotal, $parametros['area_privada']);

        return [
            'tipo'                  => $tipo,
            'subtotal'              => $totales['subtotal'],
            'administracion_12pct'  => $totales['administracion'],
            'imprevistos_3pct'      => $totales['imprevistos'],
            'utilidad_4pct'         => $totales['utilidad'],
            'iva_sobre_u_19pct'     => $totales['iva_utilidad'],
            'vr_total'              => $totales['total'],
            'precio_oferta_m2'      => $totales['precio_m2'],
            'vr_total_formateado'   => $totales['total_formateado'],
            'precio_m2_formateado'  => $totales['precio_m2_formateado'],
            'detalle'               => $detalle,
        ];
    }

    /**
     * Obtiene los items de propuesta desde la base de datos.
     */
    private function obtenerItemsPropuesta(string $tipo): Collection
    {
        return PropuestaActividad::where('tipo_propuesta', $tipo)
            ->with('actividad')
            ->get();
    }

    /**
     * Procesa cada item de la propuesta y calcula su valor total.
     */
    private function procesarItems(Collection $items, array $parametros): array
    {
        $detalle    = [];
        $numPuertas = $parametros['num_banos'] + $parametros['num_habitaciones'];

        foreach ($items as $item) {
            $actividad = $item->actividad;

            if (! $actividad) {
                continue;
            }

            $multiplicador = $this->determinarMultiplicador($actividad, $parametros, $numPuertas);
            $cantidadBase  = $this->calcularCantidadBase($item, $actividad, $parametros);
            $cantidad      = $cantidadBase * $multiplicador;

            // Items con cantidad 0 se omiten (opcionales que el usuario no eligió)
            if ($cantidad == 0) {
                continue;
            }

            $vrTotalItem = $cantidad * (float) $actividad->valor_unitario;

            $detalle[] = [
                'categoria'     => $actividad->nombre,
                'descripcion'   => $actividad->descripcion,
                'unidad'        => $actividad->unidad,
                'cantidad'      => round($cantidad, 2),
                'valor_unitario' => (int) round((float) $actividad->valor_unitario),
                'vr_total'      => (int) round($vrTotalItem),
            ];
        }

        return $detalle;
    }

    /**
     * Determina el multiplicador de cantidad según la categoría del item.
     *
     * Orden de evaluación (importante para evitar falsos positivos):
     *   1. Unidad m2          → siempre 1
     *   2. Cocina / Ropas     → siempre 1
     *   3. Habitaciones       → num_habitaciones
     *   4. Baños              → num_banos
     *   5. Puertas            → num_banos + num_habitaciones
     *   6. Default            → 1
     */
    private function determinarMultiplicador($actividad, array $parametros, int $numPuertas): int
    {
        // Unidad m2: el multiplicador de espacios siempre es 1
        // (el área ya contiene toda la superficie a cotizar)
        if (mb_strtolower($actividad->unidad, 'UTF-8') === 'm2') {
            return 1;
        }

        $textoBusqueda = mb_strtolower($actividad->nombre . ' ' . $actividad->descripcion, 'UTF-8');

        // 1. Cocina / Zona de ropas → fijo 1
        foreach (self::KEYWORDS_COCINA as $keyword) {
            if (str_contains($textoBusqueda, $keyword)) {
                return 1;
            }
        }

        // 2. Habitaciones
        foreach (self::KEYWORDS_HABITACION as $keyword) {
            if (str_contains($textoBusqueda, $keyword)) {
                return $parametros['num_habitaciones'];
            }
        }

        // 3. Baños
        foreach (self::KEYWORDS_BANO as $keyword) {
            if (str_contains($textoBusqueda, $keyword)) {
                return $parametros['num_banos'];
            }
        }

        // 4. Puertas (baños + habitaciones)
        foreach (self::KEYWORDS_PUERTA as $keyword) {
            if (str_contains($textoBusqueda, $keyword)) {
                return $numPuertas;
            }
        }

        return 1;
    }

    /**
     * Calcula la cantidad base de un item antes de aplicar el multiplicador.
     *
     * FIX: Los items cuya descripción aparece en DESCRIPCIONES_CANTIDAD_FIJA
     * siempre retornan 1, independientemente de los flags opcionales del usuario.
     * Esto soluciona que "Meson Barra auxiliar en Quarztone" (Experto) siempre sea 1
     * aunque tiene_barra_auxiliar sea false.
     */
    private function calcularCantidadBase($item, $actividad, array $parametros): float|int
    {
        // Items m2
        if (mb_strtolower($actividad->unidad, 'UTF-8') === 'm2') {
            if ($item->multiplicador_m2 !== null) {
                return $parametros['area_privada'] * (float) $item->multiplicador_m2;
            }
            if ($item->area_base > 0) {
                return (float) $item->area_base;
            }
            return $parametros['area_privada'];
        }

        // Verificar si la descripción pertenece a la lista de cantidad FIJA = 1
        $descLower = mb_strtolower((string) $actividad->descripcion, 'UTF-8');
        foreach (self::DESCRIPCIONES_CANTIDAD_FIJA as $descFija) {
            if (str_contains($descLower, mb_strtolower($descFija, 'UTF-8'))) {
                return 1;
            }
        }

        // Items opcionales del usuario
        $textoBusqueda = mb_strtolower($actividad->nombre . ' ' . $actividad->descripcion, 'UTF-8');

        if (str_contains($textoBusqueda, 'mueble alto') && str_contains($textoBusqueda, 'cocina')) {
            return $parametros['tiene_mueble_alto_cocina'] ? 1 : 0;
        }

        if (str_contains($textoBusqueda, 'barra auxiliar')) {
            return $parametros['tiene_barra_auxiliar'] ? 1 : 0;
        }

        // Items con área base fija
        if ($item->area_base > 0) {
            return (float) $item->area_base;
        }

        return 1;
    }

    /**
     * Calcula el subtotal sumando los valores de todos los items.
     */
    private function calcularSubtotal(array $detalle): float
    {
        return array_reduce($detalle, static function (float $sum, array $item): float {
            return $sum + $item['vr_total'];
        }, 0.0);
    }

    /**
     * Calcula todos los totales con AIU y formatea los valores.
     *
     * Fórmula:
     *   Administración = subtotal × 12%
     *   Imprevistos    = subtotal × 3%
     *   Utilidad       = subtotal × 4%
     *   IVA sobre U    = utilidad × 19%
     *   Total          = subtotal + admon + imprevistos + utilidad + IVA sobre U
     *   Precio m²      = total / área privada
     */
    private function calcularTotalesAIU(float $subtotal, float $areaPrivada): array
    {
        $administracion = $subtotal * self::ADMINISTRACION;
        $imprevistos    = $subtotal * self::IMPREVISTOS;
        $utilidad       = $subtotal * self::UTILIDAD;
        $ivaUtilidad    = $utilidad * self::IVA_UTILIDAD;

        $total    = $subtotal + $administracion + $imprevistos + $utilidad + $ivaUtilidad;
        $precioM2 = $areaPrivada > 0 ? $total / $areaPrivada : 0;

        return [
            'subtotal'          => (int) round($subtotal),
            'administracion'    => (int) round($administracion),
            'imprevistos'       => (int) round($imprevistos),
            'utilidad'          => (int) round($utilidad),
            'iva_utilidad'      => (int) round($ivaUtilidad),
            'total'             => (int) round($total),
            'precio_m2'         => (int) round($precioM2),
            'total_formateado'  => '$' . number_format(round($total), 0, ',', '.'),
            'precio_m2_formateado' => '$' . number_format(round($precioM2), 0, ',', '.') . '/m²',
        ];
    }
}