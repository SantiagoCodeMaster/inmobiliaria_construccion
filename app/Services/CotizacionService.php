<?php

namespace App\Services;

use App\Models\Producto;
use Carbon\Carbon;

class CotizacionService
{
    /**
     * Calcula los diferentes planes disponibles según el tipo de obra.
     */
    public function calcularPlanesDisponibles(?string $tipoObra, ?float $areaPrivada, ?string $fechaEntrega): array
    {
        // 1. Normalizar el texto
        $tipoObraNormalizado = strtolower(trim($tipoObra));

        // 2. Buscar TODOS los productos que coincidan con el tipo de obra
        $productos = Producto::where('tipo_obra', $tipoObraNormalizado)->get();

        if ($productos->isEmpty()) {
            return [
                'error' => "No tenemos planes configurados para el tipo de obra: '{$tipoObra}'. Por favor, intenta con 'obra gris' o 'vivienda usada'."
            ];
        }

        // 3. Factor de Área Privada (Nueva Lógica)
        // Asumimos que los precios de tu BD son para un área estándar de hasta 50m2.
        // Si el área es mayor a 50m2, cobramos un porcentaje extra por cada metro adicional.
        $area = $areaPrivada && $areaPrivada > 0 ? $areaPrivada : 1;
        $factorArea = 1.0; 
        
        if ($area > 50) {
            // Ejemplo: Por cada metro cuadrado extra por encima de 50, sube un 1% el valor.
            // Si son 120m2, son 70m2 extra = 70% más caro (factor 1.70). 
            // Puedes ajustar esta fórmula como prefieras.
            $metrosExtra = $area - 50;
            $factorArea = 1.0 + ($metrosExtra * 0.01); 
        }

        // 4. Factor de Urgencia (Fecha de Entrega)
        $factorUrgencia = 1.0;
        if ($fechaEntrega) {
            $fecha = Carbon::parse($fechaEntrega);
            $diasParaEntrega = Carbon::now()->diffInDays($fecha, false);

            if ($diasParaEntrega > 0 && $diasParaEntrega <= 30) {
                $factorUrgencia = 1.20; // 20% de recargo si es para menos de 30 días
            }
        }

        // 5. Calcular el total
        $planesCalculados = [];
        foreach ($productos as $producto) {
            $precioBase = (float) $producto->precio; // Los 8M, 15M, etc. que pusiste en la BD
            
            // Nueva fórmula: Precio Base * Factor de Área * Factor de Urgencia
            $totalEstimado = $precioBase * $factorArea * $factorUrgencia;

            $planesCalculados[] = [
                'id_producto'          => $producto->id_producto,
                'tipo_obra'            => $producto->tipo_obra,
                'nombre_plan'          => $producto->planes,
                
                // Valores numéricos enteros puros
                'precio_base_sugerido' => (int) round($precioBase),
                'total_a_pagar'        => (int) round($totalEstimado),

                // Valores formateados para el Frontend
                'precio_base_formateado' => '$' . number_format($precioBase, 0, ',', '.'),
                'total_formateado'       => '$' . number_format($totalEstimado, 0, ',', '.')
            ];
        }

        return $planesCalculados;
    }
}