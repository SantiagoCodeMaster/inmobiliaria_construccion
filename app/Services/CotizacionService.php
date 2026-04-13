<?php

namespace App\Services;

use App\Models\PropuestaActividad;

class CotizacionService
{
    // Porcentajes del AIU (Administración + Imprevistos + Utilidad)
    const ADMINISTRACION = 0.12;
    const IMPREVISTOS    = 0.03;
    const UTILIDAD       = 0.04;

    /**
     * Área de referencia para la que fueron configuradas las actividades m2.
     * Todas las actividades m2 del seeder usan 25 m² como base de cálculo.
     */
    const AREA_REFERENCIA = 25.0;

    /**
     * Calcula las tres propuestas (Elemental, Estándar, Experto) para un cliente.
     *
     * Para actividades m2:
     *   - Si tiene multiplicador_m2: cantidad = area_privada * multiplicador_m2
     *   - Si NO tiene multiplicador_m2: cantidad = area_base (fija, no escala)
     *
     * Para actividades UND:
     *   - Según campo_usuario: usa el valor correspondiente del cliente
     *   - Sin campo_usuario: cantidad = area_base (fija, generalmente 1)
     *
     * AIU: Administración 12% + Imprevistos 3% + Utilidad 4% = 19% sobre subtotal
     * VR Total = Subtotal * 1.19
     * Precio Oferta M2 = VR Total / area_privada
     *
     * @param array $datos Debe incluir:
     *   area_privada (float), num_puertas (int), num_closets (int), num_banos (int),
     *   tiene_mueble_alto_cocina (bool), tiene_barra_auxiliar (bool)
     */
    public function calcularPropuestas(array $datos): array
    {
        $areaPrivada            = max((float) ($datos['area_privada'] ?? self::AREA_REFERENCIA), 1.0);
        $numPuertas             = (int) ($datos['num_puertas'] ?? 0);
        $numClosets             = (int) ($datos['num_closets'] ?? 0);
        $numBanos               = max((int) ($datos['num_banos'] ?? 1), 1);
        $tieneMuebleAltoCocina  = (bool) ($datos['tiene_mueble_alto_cocina'] ?? false);
        $tieneBarraAuxiliar     = (bool) ($datos['tiene_barra_auxiliar'] ?? false);

        $resultados = [];

        foreach (['elemental', 'estandar', 'experto'] as $tipo) {
            $items = PropuestaActividad::where('tipo_propuesta', $tipo)
                ->with('actividad')
                ->get();

            $subtotal = 0.0;
            $detalle  = [];

            foreach ($items as $item) {
                $actividad = $item->actividad;

                if ($actividad->unidad === 'm2') {
                    if ($item->multiplicador_m2 !== null) {
                        // Escala con el área del usuario
                        $cantidad = $areaPrivada * (float) $item->multiplicador_m2;
                    } else {
                        // Área fija (ej. salpicadero = 15 m² siempre)
                        $cantidad = (float) $item->area_base;
                    }
                } else {
                    // UND: determinar cantidad según campo_usuario o usar area_base
                    $cantidad = match ($actividad->campo_usuario) {
                        'num_puertas'             => $numPuertas,
                        'num_closets'             => $numClosets,
                        'num_banos'               => $numBanos,
                        'tiene_mueble_alto_cocina' => $tieneMuebleAltoCocina ? 1 : 0,
                        'tiene_barra_auxiliar'    => $tieneBarraAuxiliar ? 1 : 0,
                        default                   => (float) $item->area_base,
                    };
                }

                $vrTotalItem = $cantidad * (float) $actividad->valor_unitario;
                $subtotal   += $vrTotalItem;

                $detalle[] = [
                    'categoria'      => $actividad->nombre,
                    'descripcion'    => $actividad->descripcion,
                    'unidad'         => $actividad->unidad,
                    'cantidad'       => round($cantidad, 2),
                    'valor_unitario' => (int) round((float) $actividad->valor_unitario),
                    'vr_total'       => (int) round($vrTotalItem),
                ];
            }

            $administracion = $subtotal * self::ADMINISTRACION;
            $imprevistos    = $subtotal * self::IMPREVISTOS;
            $utilidad       = $subtotal * self::UTILIDAD;
            $vrTotal        = $subtotal + $administracion + $imprevistos + $utilidad;
            $precioM2       = $areaPrivada > 0 ? $vrTotal / $areaPrivada : 0;

            $resultados[$tipo] = [
                'tipo'                   => $tipo,
                'subtotal'               => (int) round($subtotal),
                'administracion_12pct'   => (int) round($administracion),
                'imprevistos_3pct'       => (int) round($imprevistos),
                'utilidad_4pct'          => (int) round($utilidad),
                'vr_total'               => (int) round($vrTotal),
                'precio_oferta_m2'       => (int) round($precioM2),
                'vr_total_formateado'    => '$' . number_format(round($vrTotal), 0, ',', '.'),
                'precio_m2_formateado'   => '$' . number_format(round($precioM2), 0, ',', '.') . '/m²',
                'detalle'                => $detalle,
            ];
        }

        return $resultados;
    }
}
