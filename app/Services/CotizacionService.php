<?php

namespace App\Services;

use App\Models\Producto;

class CotizacionService
{
    /**
     * Calcula los planes disponibles usando la fórmula:
     * Precio Total = m² × Valor Unitario
     *
     * Cada plan (básico, medio, plus) tiene su propio valor_unitario
     * configurado por el administrador. El área del proyecto es la
     * variable que el cliente aporta.
     */
    public function calcularPlanesDisponibles(?string $tipoObra, ?float $areaPrivada): array
    {
        $tipoObraNormalizado = strtolower(trim($tipoObra));

        $productos = Producto::where('tipo_obra', $tipoObraNormalizado)->get();

        if ($productos->isEmpty()) {
            return [
                'error' => "No tenemos planes configurados para el tipo de obra: '{$tipoObra}'."
            ];
        }

        $area = ($areaPrivada && $areaPrivada > 0) ? $areaPrivada : 1;

        $planesCalculados = [];
        foreach ($productos as $producto) {
            $valorUnitario = (float) $producto->valor_unitario;

            // Fórmula universal: Precio Total = m² × Valor Unitario
            $totalEstimado = $area * $valorUnitario;

            $planesCalculados[] = [
                'id_producto'               => $producto->id_producto,
                'tipo_obra'                 => $producto->tipo_obra,
                'nombre_plan'               => $producto->planes,
                'descripcion'               => $producto->descripcion,
                'area_aplicada'             => $area,

                // Valores numéricos para cálculos en el frontend
                'valor_unitario'            => (int) round($valorUnitario),
                'total_a_pagar'             => (int) round($totalEstimado),

                // Valores formateados para mostrar al usuario
                'valor_unitario_formateado' => '$' . number_format($valorUnitario, 0, ',', '.') . '/m²',
                'total_formateado'          => '$' . number_format($totalEstimado, 0, ',', '.'),
            ];
        }

        return $planesCalculados;
    }
}
