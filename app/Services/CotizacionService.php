<?php

namespace App\Services;

use App\Models\PropuestaActividad;
use Illuminate\Support\Collection;

class CotizacionService
{
    // Constantes de porcentajes AIU (Administración, Imprevistos, Utilidad)
    private const ADMINISTRACION = 0.12;
    private const IMPREVISTOS = 0.03;
    private const UTILIDAD = 0.04;
    private const IVA_UTILIDAD = 0.19; // 19% aplicado SOLO sobre la utilidad

    // Palabras clave para la detección inteligente de categorías
    // Items que se multiplican por el número de HABITACIONES
    private const KEYWORDS_HABITACION = [
        'closet habitaciones',
        'mueble de ropas',
        'ropa'
    ];

    // Items que se multiplican por el número de BAÑOS
    private const KEYWORDS_BANO = [
        'División de Baño',
        'espejo flotado',
        'herrajes',
        'mueble flotado de baño',
        'Vidrio',
        'sanitario',
        'lavamanos',
        'ducha',
        'acoflex',
        'brida',
        'pedestal',
        'taza',
        'combo ecoclean'
    ];

    // Items que se multiplican por el número de PUERTAS (baños + habitaciones)
    private const KEYWORDS_PUERTA = [
        'puertas en madera'
    ];

    // Items que son de COCINA (SIEMPRE 1, no se multiplican)
    private const KEYWORDS_COCINA = [
        'mueble alto de cocina',
        'mueble bajo de cocina',
        'barra auxiliar de cocina',
        'campana extractora',
        'estufa de empotrar',
        'horno de empotrar',
        'punto de gas',
        'lavaplatos',
        'grifería lavaplatos',
        'kit de instalación completo para lavaplatos',
        'meson de cocina',
        'meson barra auxiliar',
        'riel spot',
        'instalacion riel spot'
    ];

    /**
     * Calcula las propuestas de cotización para los tres tipos (elemental, estándar, experto).
     *
     * @param array $datos Datos de entrada del usuario
     * @return array Resultados de cotización para cada tipo de propuesta
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
     *
     * @param array $datos
     * @return array
     */
    private function normalizarParametrosEntrada(array $datos): array
    {
        return [
            'area_privada' => max((float) ($datos['area_privada'] ?? 0), 1.0),
            'num_banos' => max((int) ($datos['num_banos'] ?? 1), 1),
            'num_habitaciones' => max((int) ($datos['num_habitaciones'] ?? 1), 1),
            'tiene_mueble_alto_cocina' => (bool) ($datos['tiene_mueble_alto_cocina'] ?? false),
            'tiene_barra_auxiliar' => (bool) ($datos['tiene_barra_auxiliar'] ?? false),
        ];
    }

    /**
     * Calcula una propuesta individual para un tipo específico.
     *
     * @param string $tipo
     * @param array $parametros
     * @return array
     */
    private function calcularPropuestaIndividual(string $tipo, array $parametros): array
    {
        $items = $this->obtenerItemsPropuesta($tipo);
        $detalle = $this->procesarItems($items, $parametros);
        $subtotal = $this->calcularSubtotal($detalle);

        $totales = $this->calcularTotalesAIU($subtotal, $parametros['area_privada']);

        return [
            'tipo' => $tipo,
            'subtotal' => $totales['subtotal'],
            'administracion_12pct' => $totales['administracion'],
            'imprevistos_3pct' => $totales['imprevistos'],
            'utilidad_4pct' => $totales['utilidad'],
            'iva_sobre_u_19pct' => $totales['iva_utilidad'],
            'vr_total' => $totales['total'],
            'precio_oferta_m2' => $totales['precio_m2'],
            'vr_total_formateado' => $totales['total_formateado'],
            'precio_m2_formateado' => $totales['precio_m2_formateado'],
            'detalle' => $detalle,
        ];
    }

    /**
     * Obtiene los items de propuesta desde la base de datos.
     *
     * @param string $tipo
     * @return Collection
     */
    private function obtenerItemsPropuesta(string $tipo): Collection
    {
        return PropuestaActividad::where('tipo_propuesta', $tipo)
            ->with('actividad')
            ->get();
    }

    /**
     * Procesa cada item de la propuesta.
     *
     * @param Collection $items
     * @param array $parametros
     * @return array
     */
    private function procesarItems(Collection $items, array $parametros): array
    {
        $detalle = [];
        $numPuertas = $parametros['num_banos'] + $parametros['num_habitaciones'];

        foreach ($items as $item) {
            $actividad = $item->actividad;
            
            if (!$actividad) {
                continue;
            }

            $multiplicador = $this->determinarMultiplicador($actividad, $parametros, $numPuertas);
            $cantidadBase = $this->calcularCantidadBase($item, $actividad, $parametros);
            $cantidad = $cantidadBase * $multiplicador;
            
            // Si la cantidad es 0, saltamos el item (para items opcionales como mueble alto cocina)
            if ($cantidad == 0) {
                continue;
            }

            $vrTotalItem = $cantidad * (float) $actividad->valor_unitario;

            $detalle[] = [
                'categoria' => $actividad->nombre,
                'descripcion' => $actividad->descripcion,
                'unidad' => $actividad->unidad,
                'cantidad' => round($cantidad, 2),
                'valor_unitario' => (int) round((float) $actividad->valor_unitario),
                'vr_total' => (int) round($vrTotalItem),
            ];
        }

        return $detalle;
    }

    /**
     * Determina el multiplicador según la categoría del item.
     *
     * @param mixed $actividad
     * @param array $parametros
     * @param int $numPuertas
     * @return int
     */
    private function determinarMultiplicador($actividad, array $parametros, int $numPuertas): int
    {
        $textoBusqueda = strtolower($actividad->nombre . ' ' . $actividad->descripcion);

        // Primero verificar si es COCINA (siempre 1, no se multiplica)
        foreach (self::KEYWORDS_COCINA as $keyword) {
            if (str_contains($textoBusqueda, $keyword)) {
                return 1;
            }
        }

        // Verificar si es HABITACIÓN
        foreach (self::KEYWORDS_HABITACION as $keyword) {
            if (str_contains($textoBusqueda, $keyword)) {
                return $parametros['num_habitaciones'];
            }
        }

        // Verificar si es BAÑO
        foreach (self::KEYWORDS_BANO as $keyword) {
            if (str_contains($textoBusqueda, $keyword)) {
                return $parametros['num_banos'];
            }
        }

        // Verificar si es PUERTA
        foreach (self::KEYWORDS_PUERTA as $keyword) {
            if (str_contains($textoBusqueda, $keyword)) {
                return $numPuertas;
            }
        }

        // Por defecto, no se multiplica (cocina u otros)
        return 1;
    }

    /**
     * Calcula la cantidad base de un item (área, unidades fijas, etc.)
     *
     * @param PropuestaActividad $item
     * @param mixed $actividad
     * @param array $parametros
     * @return float|int
     */
    private function calcularCantidadBase($item, $actividad, array $parametros): float|int
    {
        // Items que se calculan por metro cuadrado (pisos, muros, techos, aseo)
        if ($actividad->unidad === 'm2') {
            // Si tiene multiplicador_m2 específico (ej: muros = área * 3)
            if ($item->multiplicador_m2 !== null) {
                return $parametros['area_privada'] * (float) $item->multiplicador_m2;
            }
            
            // Área base fija (ej: salpicadero cocina = 15 m2 fijos)
            if ($item->area_base > 0) {
                return (float) $item->area_base;
            }
            
            // Por defecto, usa el área privada
            return $parametros['area_privada'];
        }

        // Items opcionales (mueble alto cocina, barra auxiliar)
        $textoBusqueda = strtolower($actividad->nombre . ' ' . $actividad->descripcion);
        
        if (str_contains($textoBusqueda, 'mueble alto de cocina')) {
            return $parametros['tiene_mueble_alto_cocina'] ? 1 : 0;
        }
        
        if (str_contains($textoBusqueda, 'barra auxiliar de cocina')) {
            return $parametros['tiene_barra_auxiliar'] ? 1 : 0;
        }

        // Items con área base fija
        if ($item->area_base > 0) {
            return (float) $item->area_base;
        }

        // Por defecto, 1 unidad
        return 1;
    }

    /**
     * Calcula el subtotal sumando los valores de todos los items.
     *
     * @param array $detalle
     * @return float
     */
    private function calcularSubtotal(array $detalle): float
    {
        return array_reduce($detalle, function($sum, $item) {
            return $sum + $item['vr_total'];
        }, 0.0);
    }

    /**
     * Calcula todos los totales con AIU y formateo.
     *
     * @param float $subtotal
     * @param float $areaPrivada
     * @return array
     */
    private function calcularTotalesAIU(float $subtotal, float $areaPrivada): array
    {
        $administracion = $subtotal * self::ADMINISTRACION;
        $imprevistos = $subtotal * self::IMPREVISTOS;
        $utilidad = $subtotal * self::UTILIDAD;
        $ivaUtilidad = $utilidad * self::IVA_UTILIDAD;
        
        $total = $subtotal + $administracion + $imprevistos + $utilidad + $ivaUtilidad;
        $precioM2 = $areaPrivada > 0 ? $total / $areaPrivada : 0;

        return [
            'subtotal' => (int) round($subtotal),
            'administracion' => (int) round($administracion),
            'imprevistos' => (int) round($imprevistos),
            'utilidad' => (int) round($utilidad),
            'iva_utilidad' => (int) round($ivaUtilidad),
            'total' => (int) round($total),
            'precio_m2' => (int) round($precioM2),
            'total_formateado' => '$' . number_format(round($total), 0, ',', '.'),
            'precio_m2_formateado' => '$' . number_format(round($precioM2), 0, ',', '.') . '/m²',
        ];
    }
}