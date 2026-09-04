<?php

namespace App\Services;

use App\Models\PropuestaActividad;
use Illuminate\Support\Collection;

class CotizacionService
{
    private const ADMINISTRACION = 0.12;

    private const IMPREVISTOS = 0.03;

    private const UTILIDAD = 0.04;

    private const IVA_UTILIDAD = 0.19;

    public function calcularPropuestas(array $datos): array
    {
        $parametros = $this->normalizarParametrosEntrada($datos);
        $resultados = [];

        foreach (['elemental', 'estandar', 'experto', 'maestro'] as $tipo) {
            $resultados[$tipo] = $this->calcularPropuestaIndividual($tipo, $parametros);
        }

        return $resultados;
    }

    /**
     * Descripciones amigables para el cliente en el modal Bonus Track,
     * indexadas por la descripción real de la actividad (fragmento único).
     * Cuando un ítem se marca es_bonus, el subtotal sigue sumándolo (matches
     * Excel) pero se muestra en un modal aparte como regalo de la línea.
     */
    private const BONUS_LABELS = [
        'salpicadero de cocina' => [
            'titulo' => 'Suministro y enchape completo',
            'items' => [
                'Suministro enchape (únicas referencias)',
                'Mano de obra instalación de cerámica salpicadero de cocina',
                'Zona de lavadero (completo)',
                'Cabina de ducha (si aplica)',
            ],
        ],
        'Division de Baño en vidrio' => [
            'titulo' => 'División de baño en vidrio templado',
            'items' => [
                'División de baño en vidrio templado con herrajes en acero inoxidable',
            ],
        ],
        'Barra auxiliar de cocina en aglomerado' => [
            'titulo' => 'Barra auxiliar de cocina en madera',
            'items' => [
                'Barra auxiliar de cocina en aglomerado MDP 15mm (hasta 1.2m largo)',
            ],
        ],
        'Campana extractora' => [
            'titulo' => 'Campana extractora de cocina',
            'items' => [
                'Campana extractora 60 cms 3 velocidades 210 M3/H CM60',
            ],
        ],
    ];

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

    private function calcularPropuestaIndividual(string $tipo, array $parametros): array
    {
        $items = $this->obtenerItemsPropuesta($tipo);
        $procesado = $this->procesarItems($items, $parametros);
        $detalle = $procesado['detalle'];
        $bonusTrack = $procesado['bonus_track'];

        // El subtotal SÍ incluye los ítems bonus (matches Excel): la empresa
        // los ejecuta pero al cliente se le presentan como regalo de línea.
        $subtotal = $this->calcularSubtotal($detalle) + $this->calcularSubtotal($bonusTrack);
        $aplicarAIU = $tipo !== 'maestro';
        $totales = $this->calcularTotalesAIU($subtotal, $parametros['area_privada'], $aplicarAIU);

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
            'bonus_track' => $bonusTrack,
        ];
    }

    private function obtenerItemsPropuesta(string $tipo): Collection
    {
        return PropuestaActividad::where('tipo_propuesta', $tipo)
            ->with('actividad')
            ->get();
    }

    private function procesarItems(Collection $items, array $parametros): array
    {
        $detalle = [];
        $bonus = [];

        foreach ($items as $item) {
            $actividad = $item->actividad;

            if (! $actividad) {
                continue;
            }

            $cantidad = $this->calcularCantidad($item, $actividad, $parametros);

            if ($cantidad == 0) {
                continue;
            }

            $valorUnitario = $item->valor_unitario_override !== null
                ? (float) $item->valor_unitario_override
                : (float) $actividad->valor_unitario;

            $vrTotalItem = $cantidad * $valorUnitario;

            $registro = [
                'categoria' => $actividad->nombre,
                'descripcion' => $actividad->descripcion,
                'unidad' => $actividad->unidad,
                'cantidad' => round($cantidad, 2),
                'valor_unitario' => (int) round($valorUnitario),
                'vr_total' => (int) round($vrTotalItem),
            ];

            if ($item->es_bonus) {
                $registro['bonus'] = $this->etiquetaBonus($actividad->descripcion);
                $bonus[] = $registro;
            } else {
                $detalle[] = $registro;
            }
        }

        return ['detalle' => $detalle, 'bonus_track' => $bonus];
    }

    /**
     * Busca una etiqueta amigable en BONUS_LABELS. Cae al título de la
     * actividad si no hay match.
     */
    private function etiquetaBonus(string $descripcion): array
    {
        foreach (self::BONUS_LABELS as $needle => $label) {
            if (mb_stripos($descripcion, $needle) !== false) {
                return $label;
            }
        }

        return ['titulo' => 'Bono de bienvenida', 'items' => [$descripcion]];
    }

    /**
     * Calcula la cantidad final de un item.
     *
     * Actividad m²:
     *   - multiplicador_m2 no nulo → area_privada × multiplicador_m2
     *   - multiplicador_m2 nulo    → area_base (m² fijos, ej. salpicadero 30)
     *
     * Actividad UND:
     *   - cantidad = area_base × factor(campo_usuario)
     *   - factor depende de campo_usuario:
     *     * null                        → 1  (cantidad fija: cocina/lavandería)
     *     * num_banos                   → num_banos
     *     * num_habitaciones            → num_habitaciones (closets)
     *     * num_puertas                 → num_habitaciones + num_banos
     *                                     (única categoría compartida: 1 puerta
     *                                     por alcoba + 1 por baño)
     *     * tiene_mueble_alto_cocina    → 1 o 0
     *     * tiene_barra_auxiliar        → 1 o 0
     */
    private function calcularCantidad($item, $actividad, array $parametros): float
    {
        if (mb_strtolower((string) $actividad->unidad, 'UTF-8') === 'm2') {
            if ($item->multiplicador_m2 !== null) {
                return $parametros['area_privada'] * (float) $item->multiplicador_m2;
            }

            return (float) ($item->area_base ?? 0);
        }

        $areaBase = (float) ($item->area_base ?? 1);
        $factor = $this->factorPorCampoUsuario($actividad->campo_usuario, $parametros);

        return $areaBase * $factor;
    }

    private function factorPorCampoUsuario(?string $campo, array $parametros): int
    {
        return match ($campo) {
            'num_banos' => $parametros['num_banos'],
            'num_habitaciones' => $parametros['num_habitaciones'],
            'num_puertas' => $parametros['num_habitaciones'] + $parametros['num_banos'],
            'tiene_mueble_alto_cocina' => $parametros['tiene_mueble_alto_cocina'] ? 1 : 0,
            'tiene_barra_auxiliar' => $parametros['tiene_barra_auxiliar'] ? 1 : 0,
            default => 1,
        };
    }

    private function calcularSubtotal(array $detalle): float
    {
        return array_reduce($detalle, static function (float $sum, array $item): float {
            return $sum + $item['vr_total'];
        }, 0.0);
    }

    /**
     * AIU:
     *   Administración = subtotal × 12%
     *   Imprevistos    = subtotal × 3%
     *   Utilidad       = subtotal × 4%
     *   IVA sobre U    = utilidad × 19%
     *   Total          = subtotal + admón + imprevistos + utilidad + IVA
     *   Precio m²      = total / área privada
     *
     * Si $aplicarAIU es false (maestro), todos los recargos son 0.
     */
    public function calcularTotalesAIU(float $subtotal, float $areaPrivada, bool $aplicarAIU = true): array
    {
        $administracion = $aplicarAIU ? $subtotal * self::ADMINISTRACION : 0;
        $imprevistos = $aplicarAIU ? $subtotal * self::IMPREVISTOS : 0;
        $utilidad = $aplicarAIU ? $subtotal * self::UTILIDAD : 0;
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
            'total_formateado' => '$'.number_format(round($total), 0, ',', '.'),
            'precio_m2_formateado' => '$'.number_format(round($precioM2), 0, ',', '.').'/m²',
        ];
    }
}
