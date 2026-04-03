<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    /**
     * Carga los planes de productos con la lógica de valor unitario por m².
     *
     * Fórmula: Precio Total = Área (m²) × Valor Unitario
     *
     * Ejemplos para obra gris / vivienda usada:
     *   Básico  ($645.300/m²): 35m² → $22.585.500
     *   Medio   ($823.500/m²): 35m² → $28.822.500
     *   Plus  ($1.083.300/m²): 35m² → $37.915.500
     */
    public function run(): void
    {
        // Limpiamos los productos anteriores para partir de cero
        DB::table('productos')->truncate();

        $planes = [
            // ── OBRA GRIS ────────────────────────────────────────────────────────
            [
                'tipo_obra'      => 'obra gris',
                'planes'         => 'Básico',
                'valor_unitario' => 645300.00,
                'descripcion'    => "Incluye:\n• Estructura básica en concreto\n• Mampostería en bloque\n• Cubierta en teja de barro o zinc\n• Instalaciones hidráulicas y eléctricas de primer uso\n• Acabados esenciales (piso en concreto afinado, paredes sin revocar)\n\nIdeal para: Proyectos de entrada con presupuesto ajustado.",
            ],
            [
                'tipo_obra'      => 'obra gris',
                'planes'         => 'Medio',
                'valor_unitario' => 823500.00,
                'descripcion'    => "Incluye todo lo del plan Básico, más:\n• Pañete interior y exterior\n• Pisos en cerámica nacional\n• Ventanería en aluminio\n• Baños con enchape en cerámica y sanitarios de línea estándar\n• Pintura base interior\n\nIdeal para: Proyectos con balance entre calidad y costo.",
            ],
            [
                'tipo_obra'      => 'obra gris',
                'planes'         => 'Plus',
                'valor_unitario' => 1083300.00,
                'descripcion'    => "Incluye todo lo del plan Medio, más:\n• Pisos en porcelanato importado\n• Ventanería en aluminio de alto desempeño\n• Cocina con mesón en granito o cuarzo\n• Baños con grifería premium y doble enchape\n• Pintura con acabado tipo estuco\n• Iluminación LED en áreas comunes\n\nIdeal para: Proyectos premium con acabados de alta gama.",
            ],

            // ── VIVIENDA USADA ────────────────────────────────────────────────────
            [
                'tipo_obra'      => 'vivienda usada',
                'planes'         => 'Básico',
                'valor_unitario' => 645300.00,
                'descripcion'    => "Incluye:\n• Diagnóstico estructural básico\n• Reparación de grietas y humedades puntuales\n• Repello y pintura de fachada\n• Revisión y corrección de instalaciones eléctricas e hidráulicas\n• Pisos en vinilo o cerámica económica\n\nIdeal para: Remodelaciones de mantenimiento con presupuesto ajustado.",
            ],
            [
                'tipo_obra'      => 'vivienda usada',
                'planes'         => 'Medio',
                'valor_unitario' => 823500.00,
                'descripcion'    => "Incluye todo lo del plan Básico, más:\n• Redistribución parcial de espacios (sin cambios estructurales mayores)\n• Pisos en cerámica o porcelanato nacional\n• Renovación completa de baños (sanitarios, ducha y enchape)\n• Pintura interior con acabado liso\n• Mejoras en iluminación\n\nIdeal para: Actualización integral de vivienda a precio justo.",
            ],
            [
                'tipo_obra'      => 'vivienda usada',
                'planes'         => 'Plus',
                'valor_unitario' => 1083300.00,
                'descripcion'    => "Incluye todo lo del plan Medio, más:\n• Rediseño de espacios con intervención estructural\n• Porcelanato importado en pisos y baños\n• Cocina integral con mesón en cuarzo\n• Grifería y sanitarios de línea premium\n• Cielos rasos en drywall con iluminación LED\n• Pintura tipo estuco en toda la vivienda\n\nIdeal para: Transformación total de vivienda con estándares de lujo.",
            ],
        ];

        DB::table('productos')->insert($planes);
    }
}
