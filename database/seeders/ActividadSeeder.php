<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Actividad;
use App\Models\PropuestaActividad;

/**
 * Seeder con todas las actividades del modelo de cotización de obra gris.
 *
 * Referencia de área base: 25 m² de apartamento.
 * Las actividades m2 con multiplicador_m2 escalan con el área real del usuario.
 * Las actividades UND se multiplican según las respuestas del formulario.
 *
 * Verificación de subtotales (área=25, 1 baño, 1 puerta, 1 closet,
 *   tiene_mueble_alto_cocina=true, tiene_barra_auxiliar=true):
 *   Elemental: $13.500.000  →  VR Total $16.065.000  →  $642.600/m²
 *   Estándar:  $21.350.000  →  VR Total $25.406.500  →  $1.016.260/m²
 *   Experto:   $26.301.400  →  VR Total $31.298.666  →  $1.251.947/m²
 */
class ActividadSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        PropuestaActividad::truncate();
        Actividad::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // ─── Catálogo maestro de actividades ──────────────────────────────────
        // Cada actividad tiene: nombre (categoría), descripcion, unidad,
        // valor_unitario, campo_usuario (null = fija), link (opcional)

        $actividades = [
            // ── Pisos ──────────────────────────────────────────────────────────
            [
                'nombre'         => 'Pisos',
                'descripcion'    => 'Suministro e instalación piso, nivelación y cargue de pisos en mortero',
                'unidad'         => 'm2',
                'valor_unitario' => 70000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            [
                'nombre'         => 'Pisos',
                'descripcion'    => 'Mano de obra instalación de piso en cerámica y/o piso SPC incluye guarda escobas',
                'unidad'         => 'm2',
                'valor_unitario' => 50000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            // ── Muros ──────────────────────────────────────────────────────────
            [
                'nombre'         => 'Muros',
                'descripcion'    => 'Suministro e instalación de materiales para nivelación de paredes, estuco y pintura blanca a 3 manos',
                'unidad'         => 'm2',
                'valor_unitario' => 80000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            [
                'nombre'         => 'Muros',
                'descripcion'    => 'Mano de obra instalación de cerámica salpicadero de cocina, zona de lavadero y cabina de ducha (si aplica)',
                'unidad'         => 'm2',
                'valor_unitario' => 30000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            // ── Techos ─────────────────────────────────────────────────────────
            [
                'nombre'         => 'Techos',
                'descripcion'    => 'Suministro e Instalación Drywall plano masillado y pintura a 2 manos con dilatación perimetral. Lámina Drywall RH en baño. Iluminación LED según diseño',
                'unidad'         => 'm2',
                'valor_unitario' => 150000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            // ── Aseo ───────────────────────────────────────────────────────────
            [
                'nombre'         => 'Aseo',
                'descripcion'    => 'Aseo final - Retiro de escombros a punto de acopio',
                'unidad'         => 'm2',
                'valor_unitario' => 12000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            // ── Madera ─────────────────────────────────────────────────────────
            [
                'nombre'         => 'Madera',
                'descripcion'    => 'Puertas en madera para alcoba en aglomerado MDP',
                'unidad'         => 'UND',
                'valor_unitario' => 800000,
                'campo_usuario'  => 'num_puertas',
                'link'           => null,
            ],
            [
                'nombre'         => 'Madera',
                'descripcion'    => 'Closet habitaciones en aglomerado MDP 15mm (hasta 2 m largo)',
                'unidad'         => 'UND',
                'valor_unitario' => 1800000,
                'campo_usuario'  => 'num_closets',
                'link'           => null,
            ],
            [
                'nombre'         => 'Madera',
                'descripcion'    => 'Mueble alto de cocina MDP RH 18mm (hasta 2 m largo)',
                'unidad'         => 'UND',
                'valor_unitario' => 1600000,
                'campo_usuario'  => 'tiene_mueble_alto_cocina',
                'link'           => null,
            ],
            [
                'nombre'         => 'Madera',
                'descripcion'    => 'Barra auxiliar de cocina en aglomerado MDP 15mm (Hasta 1.2 m largo)',
                'unidad'         => 'UND',
                'valor_unitario' => 850000,
                'campo_usuario'  => 'tiene_barra_auxiliar',
                'link'           => null,
            ],
            [
                'nombre'         => 'Madera',
                'descripcion'    => 'Mueble flotado de Baño aglomerado MDP 15mm',
                'unidad'         => 'UND',
                'valor_unitario' => 500000,
                'campo_usuario'  => 'num_banos',
                'link'           => null,
            ],
            [
                'nombre'         => 'Madera',
                'descripcion'    => 'Mueble de ropas aglomerado MDP 15mm',
                'unidad'         => 'UND',
                'valor_unitario' => 500000,
                'campo_usuario'  => null,  // 1 unidad fija
                'link'           => null,
            ],
            // ── Electrodomésticos ──────────────────────────────────────────────
            [
                'nombre'         => 'Electrodomésticos',
                'descripcion'    => 'Campana extractora 60 cms 3 velocidades',
                'unidad'         => 'UND',
                'valor_unitario' => 300000,
                'campo_usuario'  => null,  // siempre 1
                'link'           => 'https://www.homecenter.com.co/homecenter-co/search?Ntt=campana%20extractora%20cocina',
            ],
            // ── Vidrio ─────────────────────────────────────────────────────────
            [
                'nombre'         => 'Vidrio',
                'descripcion'    => 'División de Baño en vidrio templado con herrajes en acero inoxidable',
                'unidad'         => 'UND',
                'valor_unitario' => 1000000,
                'campo_usuario'  => 'num_banos',
                'link'           => null,
            ],
            [
                'nombre'         => 'Vidrio',
                'descripcion'    => 'Espejo flotado 4 mm + luz led',
                'unidad'         => 'UND',
                'valor_unitario' => 500000,
                'campo_usuario'  => 'num_banos',
                'link'           => null,
            ],
            // ── Electrodomésticos Experto ──────────────────────────────────────
            [
                'nombre'         => 'Electrodomésticos',
                'descripcion'    => 'Estufa de empotrar Gas natural 4 puestos en vidrio templado + instalación',
                'unidad'         => 'UND',
                'valor_unitario' => 1000000,
                'campo_usuario'  => null,
                'link'           => 'https://www.homecenter.com.co/homecenter-co/search?Ntt=estufa%20empotrar',
            ],
            [
                'nombre'         => 'Electrodomésticos',
                'descripcion'    => 'Horno de empotrar 60 cms mixto 110v y/o Gas Natural + instalación',
                'unidad'         => 'UND',
                'valor_unitario' => 1000000,
                'campo_usuario'  => null,
                'link'           => 'https://www.homecenter.com.co/homecenter-co/product/706690/horno-de-empotrar-60-cm-mixto-110-v-gas-natural-inoxidable-negro-h60eeval005/706690/',
            ],
            [
                'nombre'         => 'Punto Gas',
                'descripcion'    => 'Punto de gas horno de empotrar',
                'unidad'         => 'UND',
                'valor_unitario' => 250000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            // ── Aparatos Sanitarios (solo Experto) ────────────────────────────
            [
                'nombre'         => 'Aparatos',
                'descripcion'    => 'Combo Ecoclean Single II Negro: Sanitario con taza alongada, lavamanos con pedestal, grifería y accesorios (incrustaciones 3 piezas)',
                'unidad'         => 'UND',
                'valor_unitario' => 900000,
                'campo_usuario'  => 'num_banos',
                'link'           => 'https://corona.co/productos/sanitarios/combos-sanitarios/combo-ecoclean-single-ii-negro-sanitario-con-taza-alongada-lavamanos-con-pedestal-griferia-y-accesorios/p/501251001',
            ],
            [
                'nombre'         => 'Aparatos',
                'descripcion'    => 'Instalación Combo Ecoclean Single II Negro: Sanitario con taza alongada, lavamanos con pedestal, grifería y accesorios',
                'unidad'         => 'UND',
                'valor_unitario' => 200000,
                'campo_usuario'  => 'num_banos',
                'link'           => null,
            ],
            [
                'nombre'         => 'Aparatos',
                'descripcion'    => 'Kit Sanitario Con Brida',
                'unidad'         => 'UND',
                'valor_unitario' => 56900,
                'campo_usuario'  => 'num_banos',
                'link'           => 'https://www.homecenter.com.co/homecenter-co/product/312220/kit-instalacion-sanitario-con-brida/312220/',
            ],
            [
                'nombre'         => 'Aparatos',
                'descripcion'    => 'Instalación kit acoflex sanitario',
                'unidad'         => 'UND',
                'valor_unitario' => 50000,
                'campo_usuario'  => 'num_banos',
                'link'           => null,
            ],
            [
                'nombre'         => 'Aparatos',
                'descripcion'    => 'Kit acoflex lavamanos',
                'unidad'         => 'UND',
                'valor_unitario' => 56900,
                'campo_usuario'  => 'num_banos',
                'link'           => null,
            ],
            [
                'nombre'         => 'Aparatos',
                'descripcion'    => 'Instalación kit acoflex lavamanos',
                'unidad'         => 'UND',
                'valor_unitario' => 50000,
                'campo_usuario'  => 'num_banos',
                'link'           => null,
            ],
            [
                'nombre'         => 'Aparatos',
                'descripcion'    => 'Lavaplatos Radiante de Submontar 1 Poceta 60x40 cm Acero Inoxidable Socoda',
                'unidad'         => 'UND',
                'valor_unitario' => 108900,
                'campo_usuario'  => null,  // 1 cocina, siempre 1
                'link'           => 'https://www.homecenter.com.co/homecenter-co/product/258493/lavaplatos-para-empotrar-1-poceta-53x43-cm-acero-inoxidable/258493/',
            ],
            [
                'nombre'         => 'Aparatos',
                'descripcion'    => 'Instalación Lavaplatos Radiante de Submontar 1 Poceta 60x40 cm Acero Inoxidable Socoda',
                'unidad'         => 'UND',
                'valor_unitario' => 50000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            // ── Griferías (solo Experto) ───────────────────────────────────────
            [
                'nombre'         => 'Griferías',
                'descripcion'    => 'Grifería Lavaplatos Sencilla Gus Mueble Negra Sensi Dacqua',
                'unidad'         => 'UND',
                'valor_unitario' => 100000,
                'campo_usuario'  => null,
                'link'           => 'https://www.homecenter.com.co/homecenter-co/product/900325/griferia-lavaplatos-sencilla-gus-mueble-negra-sensi-dacqua/900325/',
            ],
            [
                'nombre'         => 'Griferías',
                'descripcion'    => 'Instalación Grifería Lavaplatos Sencilla Gus Mueble Negra Sensi Dacqua',
                'unidad'         => 'UND',
                'valor_unitario' => 50000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            [
                'nombre'         => 'Griferías',
                'descripcion'    => 'Kit De Instalación Completo Para Lavaplatos Con Canastilla 4" Pulgadas En Polimero + Sifon En P De Polimerime Gris + 2 Acoples Para Griferia De Lavaplatos De 8" Pulgadas Grival',
                'unidad'         => 'UND',
                'valor_unitario' => 58900,
                'campo_usuario'  => null,
                'link'           => 'https://www.homecenter.com.co/homecenter-co/product/138763/kit-de-instalacion-completo-para-lavaplatos-con-canastilla-4-pulgadas-en-polimero-sifon-en-p-de-polimerime-gris-2-acoples-para-griferia-de-lavaplatos-de-8-pulgadas-grival/138763/',
            ],
            [
                'nombre'         => 'Griferías',
                'descripcion'    => 'Instalación Kit De Instalación Completo Para Lavaplatos Con Canastilla 4" Pulgadas',
                'unidad'         => 'UND',
                'valor_unitario' => 50000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            [
                'nombre'         => 'Griferías',
                'descripcion'    => 'Grifería Ducha Monocontrol Nott Negra + Regadera 25X25 + Brazo Red 30 Cms',
                'unidad'         => 'UND',
                'valor_unitario' => 339900,
                'campo_usuario'  => 'num_banos',
                'link'           => 'https://www.homecenter.com.co/homecenter-co/product/721667/griferia-ducha-monocontrol-nott-negraregadera-25x25brazo-red-30-cms/721667/',
            ],
            [
                'nombre'         => 'Incrustaciones',
                'descripcion'    => 'Instalación Grifería Ducha Monocontrol Nott Negra + Regadera 25X25',
                'unidad'         => 'UND',
                'valor_unitario' => 50000,
                'campo_usuario'  => 'num_banos',
                'link'           => null,
            ],
            // ── Quarztone (solo Experto) ───────────────────────────────────────
            [
                'nombre'         => 'Quarztone',
                'descripcion'    => 'Mesón de cocina en Quarztone hasta 2 m',
                'unidad'         => 'UND',
                'valor_unitario' => 1400000,
                'campo_usuario'  => null,  // siempre 1 (1 cocina)
                'link'           => null,
            ],
            [
                'nombre'         => 'Quarztone',
                'descripcion'    => 'Mesón Barra auxiliar en Quarztone (Hasta 1.2 m largo)',
                'unidad'         => 'UND',
                'valor_unitario' => 850000,
                'campo_usuario'  => 'tiene_barra_auxiliar',
                'link'           => null,
            ],
            [
                'nombre'         => 'Quarztone',
                'descripcion'    => 'Mesón Lavamanos tipo guitarra en Quarztone',
                'unidad'         => 'UND',
                'valor_unitario' => 850000,
                'campo_usuario'  => 'num_banos',
                'link'           => null,
            ],
            // ── Iluminación (solo Experto) ─────────────────────────────────────
            [
                'nombre'         => 'Iluminación',
                'descripcion'    => 'Riel Spot 3 Luces Gu10 Negro',
                'unidad'         => 'UND',
                'valor_unitario' => 179900,
                'campo_usuario'  => null,
                'link'           => 'https://www.homecenter.com.co/homecenter-co/product/511825/riel-spot-3-luces-gu10-negro/511825/',
            ],
            [
                'nombre'         => 'Iluminación',
                'descripcion'    => 'Instalación Riel Spot 3 Luces Gu10 Negro cocina',
                'unidad'         => 'UND',
                'valor_unitario' => 50000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
        ];

        // Insertar y guardar los IDs para el pivot
        $ids = [];
        foreach ($actividades as $data) {
            $act    = Actividad::create($data);
            $ids[]  = $act->id;
        }

        // Alias para leer el array por índice humano (1-based)
        $id = fn(int $n) => $ids[$n - 1];

        // ─── Asignaciones a propuestas ────────────────────────────────────────
        //
        // multiplicador_m2:
        //   1.0  → escala 1:1 con area_privada del usuario (pisos, techos, aseo)
        //   3.0  → escala 3:1 (muros de estuco = 3 × area_privada)
        //   null → área fija (muros salpicadero = 15 m² siempre; todos los UND)
        //
        // area_base para m2 con null: cantidad fija en m² (ej. 15)
        // area_base para UND con null: cantidad fija de unidades (generalmente 1)

        $pivots = [
            // ═══════════════════════════════════
            // PROPUESTA ELEMENTAL
            // ═══════════════════════════════════
            // Subtotal base = $13.500.000 (25m², sin UND)
            ['elemental', $id(1), 25, 1.0],  // Pisos suministro
            ['elemental', $id(2), 25, 1.0],  // Pisos mano obra
            ['elemental', $id(3), 75, 3.0],  // Muros estuco  (3 × m²)
            ['elemental', $id(4), 15, null], // Muros salpicadero (15 m² fijo)
            ['elemental', $id(5), 25, 1.0],  // Techos Drywall
            ['elemental', $id(6), 25, 1.0],  // Aseo

            // ═══════════════════════════════════
            // PROPUESTA ESTÁNDAR
            // ═══════════════════════════════════
            // Subtotal base = $21.350.000 (25m², 1p, 1c, 1b, mueble_alto=true, barra=true)
            ['estandar', $id(1),  25, 1.0],  // Pisos suministro
            ['estandar', $id(2),  25, 1.0],  // Pisos mano obra
            ['estandar', $id(3),  75, 3.0],  // Muros estuco
            ['estandar', $id(4),  15, null], // Muros salpicadero
            ['estandar', $id(5),  25, 1.0],  // Techos Drywall
            ['estandar', $id(6),  25, 1.0],  // Aseo
            ['estandar', $id(7),   1, null], // Puertas       → num_puertas
            ['estandar', $id(8),   1, null], // Closets       → num_closets
            ['estandar', $id(9),   1, null], // Mueble alto   → tiene_mueble_alto_cocina
            ['estandar', $id(10),  1, null], // Barra aux     → tiene_barra_auxiliar
            ['estandar', $id(11),  1, null], // Mueble flotado baño → num_banos
            ['estandar', $id(12),  1, null], // Mueble de ropas (1 fijo)
            ['estandar', $id(13),  1, null], // Campana extractora (1 fijo)
            ['estandar', $id(14),  1, null], // División baño vidrio → num_banos
            ['estandar', $id(15),  1, null], // Espejo flotado → num_banos

            // ═══════════════════════════════════
            // PROPUESTA EXPERTO
            // ═══════════════════════════════════
            // Subtotal base = $26.301.400 (25m², 1p, 1c, 1b, barra=true)
            // Nota: NO incluye Aseo (6), Mueble alto (9), Barra aux madera (10)
            //       Los reemplaza con Quarztone (33-35) y añade aparatos premium
            ['experto', $id(1),  25, 1.0],  // Pisos suministro
            ['experto', $id(2),  25, 1.0],  // Pisos mano obra
            ['experto', $id(3),  75, 3.0],  // Muros estuco
            ['experto', $id(4),  15, null], // Muros salpicadero
            ['experto', $id(5),  25, 1.0],  // Techos Drywall
            // act 6 Aseo → NO en Experto
            ['experto', $id(7),   1, null], // Puertas
            ['experto', $id(8),   1, null], // Closets
            // act 9 Mueble alto → NO en Experto (reemplazado por Quarztone mesón)
            // act 10 Barra aux madera → NO en Experto (reemplazado por Quarztone barra)
            ['experto', $id(11),  1, null], // Mueble flotado baño
            ['experto', $id(12),  1, null], // Mueble de ropas
            ['experto', $id(13),  1, null], // Campana extractora
            ['experto', $id(14),  1, null], // División baño vidrio
            ['experto', $id(15),  1, null], // Espejo flotado
            ['experto', $id(16),  1, null], // Estufa de empotrar
            ['experto', $id(17),  1, null], // Horno de empotrar
            ['experto', $id(18),  1, null], // Punto de gas
            ['experto', $id(19),  1, null], // Combo Ecoclean
            ['experto', $id(20),  1, null], // Instalación Combo Ecoclean
            ['experto', $id(21),  1, null], // Kit Sanitario Con Brida
            ['experto', $id(22),  1, null], // Instalación kit acoflex sanitario
            ['experto', $id(23),  1, null], // Kit acoflex lavamanos
            ['experto', $id(24),  1, null], // Instalación kit acoflex lavamanos
            ['experto', $id(25),  1, null], // Lavaplatos
            ['experto', $id(26),  1, null], // Instalación Lavaplatos
            ['experto', $id(27),  1, null], // Grifería Lavaplatos
            ['experto', $id(28),  1, null], // Instalación Grifería Lavaplatos
            ['experto', $id(29),  1, null], // Kit instalación lavaplatos
            ['experto', $id(30),  1, null], // Instalación Kit instalación lavaplatos
            ['experto', $id(31),  1, null], // Grifería Ducha
            ['experto', $id(32),  1, null], // Instalación Grifería Ducha
            ['experto', $id(33),  1, null], // Quarztone mesón cocina
            ['experto', $id(34),  1, null], // Quarztone barra → tiene_barra_auxiliar
            ['experto', $id(35),  1, null], // Quarztone lavamanos → num_banos
            ['experto', $id(36),  1, null], // Riel Spot
            ['experto', $id(37),  1, null], // Instalación Riel Spot
        ];

        foreach ($pivots as [$tipo, $actividadId, $areaBase, $multiplicador]) {
            PropuestaActividad::create([
                'tipo_propuesta'  => $tipo,
                'actividad_id'    => $actividadId,
                'area_base'       => $areaBase,
                'multiplicador_m2' => $multiplicador,
            ]);
        }
    }
}
