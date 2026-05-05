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
 * Verificación de subtotales (área=52, 3 habitaciones, 2 baños,
 *   tiene_mueble_alto_cocina=true, tiene_barra_auxiliar=true):
 *   Elemental: $27.594.000  →  VR Total $33.046.574  →  $635.511/m²
 *   Estándar:  $44.244.000  →  VR Total $52.986.614  →  $1.018.973/m²
 *   Experto:   $55.249.100  →  VR Total $66.166.322  →  $1.272.429/m²
 *
 * CORRECCIONES vs versión anterior:
 *   1. Experto ahora SÍ incluye Aseo (igual que Elemental y Estándar)
 *   2. Experto ahora SÍ incluye Mueble alto cocina (igual que Estándar)
 *   3. Se agregó "Mueble bajo de cocina" (exclusivo de Experto, siempre 1 UND)
 *   4. En Experto, la Barra Quarztone es SIEMPRE 1 (no condicional)
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
            // ── 1. Pisos ───────────────────────────────────────────────────────
            [
                'nombre'         => 'Pisos',
                'descripcion'    => 'Suministro e instalación piso, nivelación y cargue de pisos en mortero',
                'unidad'         => 'm2',
                'valor_unitario' => 70000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            // ── 2. Pisos MO ────────────────────────────────────────────────────
            [
                'nombre'         => 'Pisos',
                'descripcion'    => 'Mano de obra instalación de piso en cerámica y/o piso SPC incluye guarda escobas',
                'unidad'         => 'm2',
                'valor_unitario' => 50000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            // ── 3. Muros estuco ────────────────────────────────────────────────
            [
                'nombre'         => 'Muros',
                'descripcion'    => 'Suministro e instalación de materiales para nivelación de paredes, estuco y pintura blanca a 3 manos',
                'unidad'         => 'm2',
                'valor_unitario' => 80000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            // ── 4. Muros salpicadero ───────────────────────────────────────────
            [
                'nombre'         => 'Muros',
                'descripcion'    => 'Mano de obra instalación de cerámica salpicadero de cocina, zona de lavadero y cabina de ducha (si aplica)',
                'unidad'         => 'm2',
                'valor_unitario' => 30000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            // ── 5. Techos ──────────────────────────────────────────────────────
            [
                'nombre'         => 'Techos',
                'descripcion'    => 'Suministro e Instalación Drywall plano masillado y pintura a 2 manos con dilatación perimetral. Lámina Drywall RH en baño. Iluminación LED según diseño',
                'unidad'         => 'm2',
                'valor_unitario' => 150000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            // ── 6. Aseo ────────────────────────────────────────────────────────
            [
                'nombre'         => 'Aseo',
                'descripcion'    => 'Aseo final - Retiro de escombros a punto de acopio',
                'unidad'         => 'm2',
                'valor_unitario' => 12000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            // ── 7. Puertas ────────────────────────────────────────────────────
            [
                'nombre'         => 'Madera',
                'descripcion'    => 'Puertas en madera para alcoba en aglomerado MDP',
                'unidad'         => 'UND',
                'valor_unitario' => 800000,
                'campo_usuario'  => 'num_puertas',
                'link'           => null,
            ],
            // ── 8. Closet ─────────────────────────────────────────────────────
            [
                'nombre'         => 'Madera',
                'descripcion'    => 'Closet habitaciones en aglomerado MDP 15mm (hasta 2 m largo)',
                'unidad'         => 'UND',
                'valor_unitario' => 1800000,
                'campo_usuario'  => 'num_closets',
                'link'           => null,
            ],
            // ── 9. Mueble alto cocina ─────────────────────────────────────────
            [
                'nombre'         => 'Madera',
                'descripcion'    => 'Mueble alto de cocina MDP RH 18mm (hasta 2 m largo)',
                'unidad'         => 'UND',
                'valor_unitario' => 1600000,
                'campo_usuario'  => 'tiene_mueble_alto_cocina',
                'link'           => null,
            ],
            // ── 10. Mueble bajo cocina (exclusivo Experto, siempre 1) ──────────
            // NUEVO: En el Excel, la línea Experto incluye "Mueble alto - Mueble bajo"
            // como un ítem separado de 1 UND a $1.600.000
            [
                'nombre'         => 'Madera',
                'descripcion'    => 'Mueble bajo de cocina MDP RH 18mm (hasta 2 m largo)',
                'unidad'         => 'UND',
                'valor_unitario' => 1600000,
                'campo_usuario'  => null,  // siempre 1 (exclusivo Experto)
                'link'           => null,
            ],
            // ── 11. Barra auxiliar madera ─────────────────────────────────────
            [
                'nombre'         => 'Madera',
                'descripcion'    => 'Barra auxiliar de cocina en aglomerado MDP 15mm (Hasta 1.2 m largo)',
                'unidad'         => 'UND',
                'valor_unitario' => 850000,
                'campo_usuario'  => 'tiene_barra_auxiliar',
                'link'           => null,
            ],
            // ── 12. Mueble flotado baño ───────────────────────────────────────
            [
                'nombre'         => 'Madera',
                'descripcion'    => 'Mueble flotado de Baño aglomerado MDP 15mm',
                'unidad'         => 'UND',
                'valor_unitario' => 500000,
                'campo_usuario'  => 'num_banos',
                'link'           => null,
            ],
            // ── 13. Mueble de ropas ───────────────────────────────────────────
            [
                'nombre'         => 'Madera',
                'descripcion'    => 'Mueble de ropas aglomerado MDP 15mm',
                'unidad'         => 'UND',
                'valor_unitario' => 500000,
                'campo_usuario'  => null,  // 1 unidad fija
                'link'           => null,
            ],
            // ── 14. Campana extractora ────────────────────────────────────────
            [
                'nombre'         => 'Electrodomésticos',
                'descripcion'    => 'Campana extractora 60 cms 3 velocidades',
                'unidad'         => 'UND',
                'valor_unitario' => 300000,
                'campo_usuario'  => null,  // siempre 1
                'link'           => 'https://www.homecenter.com.co/homecenter-co/search?Ntt=campana%20extractora%20cocina',
            ],
            // ── 15. División de baño ──────────────────────────────────────────
            [
                'nombre'         => 'Vidrio',
                'descripcion'    => 'División de Baño en vidrio templado con herrajes en acero inoxidable',
                'unidad'         => 'UND',
                'valor_unitario' => 1000000,
                'campo_usuario'  => 'num_banos',
                'link'           => null,
            ],
            // ── 16. Espejo flotado ────────────────────────────────────────────
            [
                'nombre'         => 'Vidrio',
                'descripcion'    => 'Espejo flotado 4 mm + luz led',
                'unidad'         => 'UND',
                'valor_unitario' => 500000,
                'campo_usuario'  => 'num_banos',
                'link'           => null,
            ],
            // ── 17. Estufa de empotrar ────────────────────────────────────────
            [
                'nombre'         => 'Electrodomésticos',
                'descripcion'    => 'Estufa de empotrar Gas natural 4 puestos en vidrio templado + instalación',
                'unidad'         => 'UND',
                'valor_unitario' => 1000000,
                'campo_usuario'  => null,
                'link'           => 'https://www.homecenter.com.co/homecenter-co/search?Ntt=estufa%20empotrar',
            ],
            // ── 18. Horno de empotrar ─────────────────────────────────────────
            [
                'nombre'         => 'Electrodomésticos',
                'descripcion'    => 'Horno de empotrar 60 cms mixto 110v y/o Gas Natural + instalación',
                'unidad'         => 'UND',
                'valor_unitario' => 1000000,
                'campo_usuario'  => null,
                'link'           => 'https://www.homecenter.com.co/homecenter-co/product/706690/horno-de-empotrar-60-cm-mixto-110-v-gas-natural-inoxidable-negro-h60eeval005/706690/',
            ],
            // ── 19. Punto de gas ──────────────────────────────────────────────
            [
                'nombre'         => 'Punto Gas',
                'descripcion'    => 'Punto de gas horno de empotrar',
                'unidad'         => 'UND',
                'valor_unitario' => 250000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            // ── 20. Combo Ecoclean ────────────────────────────────────────────
            [
                'nombre'         => 'Aparatos',
                'descripcion'    => 'Combo Ecoclean Single II Negro: Sanitario con taza alongada, lavamanos con pedestal, grifería y accesorios (incrustaciones 3 piezas)',
                'unidad'         => 'UND',
                'valor_unitario' => 900000,
                'campo_usuario'  => 'num_banos',
                'link'           => 'https://corona.co/productos/sanitarios/combos-sanitarios/combo-ecoclean-single-ii-negro-sanitario-con-taza-alongada-lavamanos-con-pedestal-griferia-y-accesorios/p/501251001',
            ],
            // ── 21. Instalación Combo Ecoclean ────────────────────────────────
            [
                'nombre'         => 'Aparatos',
                'descripcion'    => 'Instalación Combo Ecoclean Single II Negro: Sanitario con taza alongada, lavamanos con pedestal, grifería y accesorios',
                'unidad'         => 'UND',
                'valor_unitario' => 200000,
                'campo_usuario'  => 'num_banos',
                'link'           => null,
            ],
            // ── 22. Kit Sanitario Con Brida ───────────────────────────────────
            [
                'nombre'         => 'Aparatos',
                'descripcion'    => 'Kit Sanitario Con Brida',
                'unidad'         => 'UND',
                'valor_unitario' => 56900,
                'campo_usuario'  => 'num_banos',
                'link'           => 'https://www.homecenter.com.co/homecenter-co/product/312220/kit-instalacion-sanitario-con-brida/312220/',
            ],
            // ── 23. Instalación kit acoflex sanitario ─────────────────────────
            [
                'nombre'         => 'Aparatos',
                'descripcion'    => 'Instalación kit acoflex sanitario',
                'unidad'         => 'UND',
                'valor_unitario' => 50000,
                'campo_usuario'  => 'num_banos',
                'link'           => null,
            ],
            // ── 24. Kit acoflex lavamanos ─────────────────────────────────────
            [
                'nombre'         => 'Aparatos',
                'descripcion'    => 'Kit acoflex lavamanos',
                'unidad'         => 'UND',
                'valor_unitario' => 56900,
                'campo_usuario'  => 'num_banos',
                'link'           => null,
            ],
            // ── 25. Instalación kit acoflex lavamanos ─────────────────────────
            [
                'nombre'         => 'Aparatos',
                'descripcion'    => 'Instalación kit acoflex lavamanos',
                'unidad'         => 'UND',
                'valor_unitario' => 50000,
                'campo_usuario'  => 'num_banos',
                'link'           => null,
            ],
            // ── 26. Lavaplatos ────────────────────────────────────────────────
            [
                'nombre'         => 'Aparatos',
                'descripcion'    => 'Lavaplatos Radiante de Submontar 1 Poceta 60x40 cm Acero Inoxidable Socoda',
                'unidad'         => 'UND',
                'valor_unitario' => 108900,
                'campo_usuario'  => null,  // 1 cocina, siempre 1
                'link'           => 'https://www.homecenter.com.co/homecenter-co/product/258493/lavaplatos-para-empotrar-1-poceta-53x43-cm-acero-inoxidable/258493/',
            ],
            // ── 27. Instalación Lavaplatos ────────────────────────────────────
            [
                'nombre'         => 'Aparatos',
                'descripcion'    => 'Instalación Lavaplatos Radiante de Submontar 1 Poceta 60x40 cm Acero Inoxidable Socoda',
                'unidad'         => 'UND',
                'valor_unitario' => 50000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            // ── 28. Grifería Lavaplatos ───────────────────────────────────────
            [
                'nombre'         => 'Griferías',
                'descripcion'    => 'Grifería Lavaplatos Sencilla Gus Mueble Negra Sensi Dacqua',
                'unidad'         => 'UND',
                'valor_unitario' => 100000,
                'campo_usuario'  => null,
                'link'           => 'https://www.homecenter.com.co/homecenter-co/product/900325/griferia-lavaplatos-sencilla-gus-mueble-negra-sensi-dacqua/900325/',
            ],
            // ── 29. Instalación Grifería Lavaplatos ───────────────────────────
            [
                'nombre'         => 'Griferías',
                'descripcion'    => 'Instalación Grifería Lavaplatos Sencilla Gus Mueble Negra Sensi Dacqua',
                'unidad'         => 'UND',
                'valor_unitario' => 50000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            // ── 30. Kit instalación lavaplatos ────────────────────────────────
            [
                'nombre'         => 'Griferías',
                'descripcion'    => 'Kit De Instalación Completo Para Lavaplatos Con Canastilla 4" Pulgadas En Polimero + Sifon En P De Polimerime Gris + 2 Acoples Para Griferia De Lavaplatos De 8" Pulgadas Grival',
                'unidad'         => 'UND',
                'valor_unitario' => 58900,
                'campo_usuario'  => null,
                'link'           => 'https://www.homecenter.com.co/homecenter-co/product/138763/kit-de-instalacion-completo-para-lavaplatos-con-canastilla-4-pulgadas-en-polimero-sifon-en-p-de-polimerime-gris-2-acoples-para-griferia-de-lavaplatos-de-8-pulgadas-grival/138763/',
            ],
            // ── 31. Instalación kit lavaplatos ────────────────────────────────
            [
                'nombre'         => 'Griferías',
                'descripcion'    => 'Instalación Kit De Instalación Completo Para Lavaplatos Con Canastilla 4" Pulgadas',
                'unidad'         => 'UND',
                'valor_unitario' => 50000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            // ── 32. Grifería Ducha ────────────────────────────────────────────
            [
                'nombre'         => 'Griferías',
                'descripcion'    => 'Grifería Ducha Monocontrol Nott Negra + Regadera 25X25 + Brazo Red 30 Cms',
                'unidad'         => 'UND',
                'valor_unitario' => 339900,
                'campo_usuario'  => 'num_banos',
                'link'           => 'https://www.homecenter.com.co/homecenter-co/product/721667/griferia-ducha-monocontrol-nott-negraregadera-25x25brazo-red-30-cms/721667/',
            ],
            // ── 33. Instalación Grifería Ducha ────────────────────────────────
            [
                'nombre'         => 'Incrustaciones',
                'descripcion'    => 'Instalación Grifería Ducha Monocontrol Nott Negra + Regadera 25X25',
                'unidad'         => 'UND',
                'valor_unitario' => 50000,
                'campo_usuario'  => 'num_banos',
                'link'           => null,
            ],
            // ── 34. Quarztone mesón cocina ────────────────────────────────────
            [
                'nombre'         => 'Quarztone',
                'descripcion'    => 'Mesón de cocina en Quarztone hasta 2 m',
                'unidad'         => 'UND',
                'valor_unitario' => 1400000,
                'campo_usuario'  => null,  // siempre 1 (1 cocina)
                'link'           => null,
            ],
            // ── 35. Quarztone barra auxiliar ──────────────────────────────────
            // CORRECCIÓN: En Experto la barra Quarztone es SIEMPRE 1, no condicional.
            // El Excel muestra cantidad=1 independientemente de tiene_barra_auxiliar.
            [
                'nombre'         => 'Quarztone',
                'descripcion'    => 'Mesón Barra auxiliar en Quarztone (Hasta 1.2 m largo)',
                'unidad'         => 'UND',
                'valor_unitario' => 850000,
                'campo_usuario'  => null,  // siempre 1 en Experto
                'link'           => null,
            ],
            // ── 36. Quarztone lavamanos ────────────────────────────────────────
            [
                'nombre'         => 'Quarztone',
                'descripcion'    => 'Mesón Lavamanos tipo guitarra en Quarztone',
                'unidad'         => 'UND',
                'valor_unitario' => 850000,
                'campo_usuario'  => 'num_banos',
                'link'           => null,
            ],
            // ── 37. Riel Spot ─────────────────────────────────────────────────
            [
                'nombre'         => 'Iluminación',
                'descripcion'    => 'Riel Spot 3 Luces Gu10 Negro',
                'unidad'         => 'UND',
                'valor_unitario' => 179900,
                'campo_usuario'  => null,
                'link'           => 'https://www.homecenter.com.co/homecenter-co/product/511825/riel-spot-3-luces-gu10-negro/511825/',
            ],
            // ── 38. Instalación Riel Spot ─────────────────────────────────────
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
            $act   = Actividad::create($data);
            $ids[] = $act->id;
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
        // area_base para m2 con multiplicador null: cantidad fija en m² (ej. 15)
        // area_base para UND: cantidad base (el multiplicador la escala por num_banos/hab/etc.)

        $pivots = [
            // ═══════════════════════════════════
            // PROPUESTA ELEMENTAL
            // Solo pisos, muros, techos y aseo. Sin carpintería ni accesorios.
            // ═══════════════════════════════════
            ['elemental', $id(1), 25, 1.0],   // Pisos suministro     (× area_privada)
            ['elemental', $id(2), 25, 1.0],   // Pisos mano obra      (× area_privada)
            ['elemental', $id(3), 75, 3.0],   // Muros estuco         (× area_privada × 3)
            ['elemental', $id(4), 15, null],  // Muros salpicadero    (15 m² fijo)
            ['elemental', $id(5), 25, 1.0],   // Techos Drywall       (× area_privada)
            ['elemental', $id(6), 25, 1.0],   // Aseo                 (× area_privada)

            // ═══════════════════════════════════
            // PROPUESTA ESTÁNDAR
            // Todo Elemental + carpintería + vidrio. Sin aparatos premium ni Quarztone.
            // ═══════════════════════════════════
            ['estandar', $id(1),  25, 1.0],   // Pisos suministro
            ['estandar', $id(2),  25, 1.0],   // Pisos mano obra
            ['estandar', $id(3),  75, 3.0],   // Muros estuco
            ['estandar', $id(4),  15, null],  // Muros salpicadero
            ['estandar', $id(5),  25, 1.0],   // Techos Drywall
            ['estandar', $id(6),  25, 1.0],   // Aseo
            ['estandar', $id(7),   1, null],  // Puertas              → × num_puertas (banos+hab)
            ['estandar', $id(8),   1, null],  // Closets              → × num_habitaciones
            ['estandar', $id(9),   1, null],  // Mueble alto cocina   → condicional tiene_mueble_alto
            ['estandar', $id(11),  1, null],  // Barra auxiliar MDP   → condicional tiene_barra_auxiliar
            ['estandar', $id(12),  1, null],  // Mueble flotado baño  → × num_banos
            ['estandar', $id(13),  1, null],  // Mueble de ropas      (1 fijo)
            ['estandar', $id(14),  1, null],  // Campana extractora   (1 fijo)
            ['estandar', $id(15),  1, null],  // División baño        → × num_banos
            ['estandar', $id(16),  1, null],  // Espejo flotado       → × num_banos

            // ═══════════════════════════════════
            // PROPUESTA EXPERTO
            // Todo Estándar + aparatos premium + Quarztone + griferías lujo.
            //
            // DIFERENCIAS clave vs Estándar:
            //   + Incluye Mueble bajo cocina (ítem 10, siempre 1 UND, solo en Experto)
            //   + Incluye Estufa, Horno, Punto gas
            //   + Incluye Aparatos sanitarios premium (Ecoclean, Brida, Acoflex)
            //   + Incluye Lavaplatos + grifería lavaplatos
            //   + Incluye Griferías ducha de lujo
            //   + Incluye Quarztone mesón, barra (siempre 1), lavamanos
            //   + Incluye Riel Spot iluminación
            //   + SÍ incluye Aseo (igual que Elemental y Estándar)
            //   + SÍ incluye Mueble alto cocina (igual que Estándar)
            //   + La barra Quarztone es siempre 1 (no condicional)
            // ═══════════════════════════════════
            ['experto', $id(1),  25, 1.0],   // Pisos suministro
            ['experto', $id(2),  25, 1.0],   // Pisos mano obra
            ['experto', $id(3),  75, 3.0],   // Muros estuco
            ['experto', $id(4),  15, null],  // Muros salpicadero
            ['experto', $id(5),  25, 1.0],   // Techos Drywall
            ['experto', $id(6),  25, 1.0],   // Aseo  ← CORRECCIÓN: SÍ está en Experto
            ['experto', $id(7),   1, null],  // Puertas              → × num_puertas
            ['experto', $id(8),   1, null],  // Closets              → × num_habitaciones
            ['experto', $id(9),   1, null],  // Mueble alto cocina   ← CORRECCIÓN: SÍ en Experto
            ['experto', $id(10),  1, null],  // Mueble bajo cocina   (1 fijo, exclusivo Experto)
            // Barra auxiliar MDP (íd 11) → NO en Experto (se reemplaza por Quarztone barra)
            ['experto', $id(12),  1, null],  // Mueble flotado baño  → × num_banos
            ['experto', $id(13),  1, null],  // Mueble de ropas      (1 fijo)
            ['experto', $id(14),  1, null],  // Campana extractora   (1 fijo)
            ['experto', $id(15),  1, null],  // División baño        → × num_banos
            ['experto', $id(16),  1, null],  // Espejo flotado       → × num_banos
            ['experto', $id(17),  1, null],  // Estufa de empotrar   (1 fijo)
            ['experto', $id(18),  1, null],  // Horno de empotrar    (1 fijo)
            ['experto', $id(19),  1, null],  // Punto de gas         (1 fijo)
            ['experto', $id(20),  1, null],  // Combo Ecoclean       → × num_banos
            ['experto', $id(21),  1, null],  // Inst. Combo Ecoclean → × num_banos
            ['experto', $id(22),  1, null],  // Kit Brida            → × num_banos
            ['experto', $id(23),  1, null],  // Inst. acoflex san.   → × num_banos
            ['experto', $id(24),  1, null],  // Kit acoflex lav.     → × num_banos
            ['experto', $id(25),  1, null],  // Inst. acoflex lav.   → × num_banos
            ['experto', $id(26),  1, null],  // Lavaplatos           (1 fijo)
            ['experto', $id(27),  1, null],  // Inst. Lavaplatos     (1 fijo)
            ['experto', $id(28),  1, null],  // Grifería Lavaplatos  (1 fijo)
            ['experto', $id(29),  1, null],  // Inst. Grifería Lav.  (1 fijo)
            ['experto', $id(30),  1, null],  // Kit inst. lavaplatos (1 fijo)
            ['experto', $id(31),  1, null],  // Inst. kit lavaplatos (1 fijo)
            ['experto', $id(32),  1, null],  // Grifería Ducha       → × num_banos
            ['experto', $id(33),  1, null],  // Inst. Grifería Ducha → × num_banos
            ['experto', $id(34),  1, null],  // Quarztone mesón      (1 fijo)
            ['experto', $id(35),  1, null],  // Quarztone barra      (1 fijo - siempre 1 en Experto)
            ['experto', $id(36),  1, null],  // Quarztone lavamanos  → × num_banos
            ['experto', $id(37),  1, null],  // Riel Spot            (1 fijo)
            ['experto', $id(38),  1, null],  // Inst. Riel Spot      (1 fijo)
        ];

        foreach ($pivots as [$tipo, $actividadId, $areaBase, $multiplicador]) {
            PropuestaActividad::create([
                'tipo_propuesta'   => $tipo,
                'actividad_id'     => $actividadId,
                'area_base'        => $areaBase,
                'multiplicador_m2' => $multiplicador,
            ]);
        }
    }
}