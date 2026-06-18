<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Actividad;
use App\Models\PropuestaActividad;

/**
 * Seeder con todas las actividades del modelo de cotización.
 *
 * REFERENCIA DE VERIFICACIÓN (área=52, 3 habitaciones, 2 baños,
 *   tiene_mueble_alto_cocina=true, tiene_barra_auxiliar=true):
 *
 *   Elemental: subtotal=$27.594.000  →  VR Total $33.046.574  →  $635.511/m²
 *   Estándar:  subtotal=$44.244.000  →  VR Total $52.986.614  →  $1.018.973/m²
 *   Experto:   subtotal=$55.249.100  →  VR Total $66.166.322  →  $1.272.429/m²
 *
 * FÓRMULA AIU:
 *   Administración = subtotal × 12%
 *   Imprevistos    = subtotal × 3%
 *   Utilidad       = subtotal × 4%
 *   IVA sobre U    = utilidad × 19%
 *   Total          = subtotal + admon + imprevistos + utilidad + IVA
 *
 * LÓGICA DE MULTIPLICADORES (ver CotizacionService):
 *   m2 con multiplicador_m2 = 1.0  → cantidad = area_privada × 1
 *   m2 con multiplicador_m2 = 3.0  → cantidad = area_privada × 3  (muros)
 *   m2 con multiplicador_m2 = null → cantidad = area_base fija  (salpicadero = 15 m²)
 *   UND                            → cantidad = area_base × multiplicador_espacios
 *                                    donde multiplicador_espacios depende de keywords
 *
 * CORRECCIONES VS VERSIÓN ANTERIOR:
 *   1. Experto SÍ incluye Aseo (igual que Elemental y Estándar)
 *   2. Experto SÍ incluye Mueble alto cocina (igual que Estándar)
 *   3. Se agregó "Mueble bajo de cocina" (exclusivo Experto, siempre 1 UND)
 *   4. En Experto, la Barra Quarztone es SIEMPRE 1 (no condicional)
 *      → garantizado por CotizacionService::DESCRIPCIONES_CANTIDAD_FIJA
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
        $actividades = [
            // ── 1. Pisos suministro ──────────────────────────────────────────
            [
                'nombre'         => 'Pisos',
                'descripcion'    => 'Suministro e instalación piso , nivelacion y cargue de pisos en mortero',
                'unidad'         => 'm2',
                'valor_unitario' => 70000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            // ── 2. Pisos mano de obra ────────────────────────────────────────
            [
                'nombre'         => 'Pisos',
                'descripcion'    => 'Mano de obra instalacion de piso en ceramica y/o piso SPC incluye guarda escobas',
                'unidad'         => 'm2',
                'valor_unitario' => 50000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            // ── 3. Muros estuco + pintura ────────────────────────────────────
            [
                'nombre'         => 'Muros',
                'descripcion'    => 'Suministro e instalacion de materiales para nivelacion de paredes, estuco y pintura blnaca a 3 manos',
                'unidad'         => 'm2',
                'valor_unitario' => 80000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            // ── 4. Muros salpicadero ─────────────────────────────────────────
            [
                'nombre'         => 'Muros',
                'descripcion'    => 'Mano de obra instalacion de ceramica salpicadero de cocina, y zona de lavadero, cabina de ducha (si aplica)',
                'unidad'         => 'm2',
                'valor_unitario' => 30000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            // ── 5. Techos Drywall ────────────────────────────────────────────
            [
                'nombre'         => 'Techos',
                'descripcion'    => 'Suministro e Instalacion Drywall plano masillado y pintura a 2 manos con dilatacion perimetral. Lamina Drywall RH en baño. Cambio  Iluminacion LED según diseño',
                'unidad'         => 'm2',
                'valor_unitario' => 150000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            // ── 6. Aseo ─────────────────────────────────────────────────────
            [
                'nombre'         => 'Aseo',
                'descripcion'    => 'Aseo final- Retiro de escombros a punto de acopio',
                'unidad'         => 'm2',
                'valor_unitario' => 12000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            // ── 7. Puertas ───────────────────────────────────────────────────
            [
                'nombre'         => 'Madera',
                'descripcion'    => 'Puertas en madera para alcoba en aglomerado MDP',
                'unidad'         => 'UND',
                'valor_unitario' => 800000,
                'campo_usuario'  => 'num_puertas',
                'link'           => null,
            ],
            // ── 8. Closet ────────────────────────────────────────────────────
            [
                'nombre'         => 'Madera',
                'descripcion'    => 'closet habitaciones en aglomerado MDP 15mm (hasta 2 m largo)',
                'unidad'         => 'UND',
                'valor_unitario' => 1800000,
                'campo_usuario'  => 'num_closets',
                'link'           => null,
            ],
            // ── 9. Mueble alto cocina ────────────────────────────────────────
            [
                'nombre'         => 'Madera',
                'descripcion'    => 'Mueble alto  de cocina MDP RH 18mm (hasta 2 m largo)',
                'unidad'         => 'UND',
                'valor_unitario' => 1600000,
                'campo_usuario'  => 'tiene_mueble_alto_cocina',
                'link'           => null,
            ],
            // ── 10. Mueble bajo cocina (exclusivo Experto, siempre 1) ────────
            [
                'nombre'         => 'Madera',
                'descripcion'    => 'Mueble alto- Mueble bajo   de cocina MDP RH 18mm (hasta 2 m largo)',
                'unidad'         => 'UND',
                'valor_unitario' => 1600000,
                'campo_usuario'  => null,  // siempre 1 (exclusivo Experto)
                'link'           => null,
            ],
            // ── 11. Barra auxiliar MDP (Estándar) ────────────────────────────
            [
                'nombre'         => 'Madera',
                'descripcion'    => 'Barra auxiliar de cocina en aglomerado MDP 15mm (Hasta1.2m largo )',
                'unidad'         => 'UND',
                'valor_unitario' => 850000,
                'campo_usuario'  => 'tiene_barra_auxiliar',
                'link'           => null,
            ],
            // ── 12. Mueble flotado baño ──────────────────────────────────────
            [
                'nombre'         => 'Madera',
                'descripcion'    => 'Mueble flotado de Baño  aglomerado MDP 15mm',
                'unidad'         => 'UND',
                'valor_unitario' => 500000,
                'campo_usuario'  => 'num_banos',
                'link'           => null,
            ],
            // ── 13. Mueble de ropas ──────────────────────────────────────────
            [
                'nombre'         => 'Madera',
                'descripcion'    => 'Mueble de ropas  aglomerado MDP 15mm',
                'unidad'         => 'UND',
                'valor_unitario' => 500000,
                'campo_usuario'  => null,  // 1 unidad fija
                'link'           => null,
            ],
            // ── 14. Campana extractora ───────────────────────────────────────
            [
                'nombre'         => 'Electrodomesticos',
                'descripcion'    => 'campana extractora 60 cms 3 velocoidades',
                'unidad'         => 'UND',
                'valor_unitario' => 300000,
                'campo_usuario'  => null,  // siempre 1
                'link'           => 'https://www.homecenter.com.co/homecenter-co/search?Ntt=campana%20extractora%20cocina',
            ],
            // ── 15. División de baño ─────────────────────────────────────────
            [
                'nombre'         => 'Vidrio',
                'descripcion'    => 'Division de Baño en vidrio templado con herrajes en acero inoxidable',
                'unidad'         => 'UND',
                'valor_unitario' => 1000000,
                'campo_usuario'  => 'num_banos',
                'link'           => null,
            ],
            // ── 16. Espejo flotado ───────────────────────────────────────────
            [
                'nombre'         => 'Vidrio',
                'descripcion'    => 'Espejo flotado 4 mm + luz led',
                'unidad'         => 'UND',
                'valor_unitario' => 500000,
                'campo_usuario'  => 'num_banos',
                'link'           => null,
            ],
            // ── 17. Estufa de empotrar ───────────────────────────────────────
            [
                'nombre'         => 'Electrodomesticos',
                'descripcion'    => 'Estufa de empotrar Gas natural 4 puestos en vidrio templado+ instalacion',
                'unidad'         => 'UND',
                'valor_unitario' => 1000000,
                'campo_usuario'  => null,
                'link'           => 'https://www.homecenter.com.co/homecenter-co/search?Ntt=estufa%20empotrar',
            ],
            // ── 18. Horno de empotrar ────────────────────────────────────────
            [
                'nombre'         => 'Electrodomesticos',
                'descripcion'    => 'Horno de empotrar 60 cms mixto 110v y/o Gas Natural+instalacion',
                'unidad'         => 'UND',
                'valor_unitario' => 1000000,
                'campo_usuario'  => null,
                'link'           => 'https://www.homecenter.com.co/homecenter-co/product/706690/horno-de-empotrar-60-cm-mixto-110-v-gas-natural-inoxidable-negro-h60eeval005/706690/',
            ],
            // ── 19. Punto de gas ─────────────────────────────────────────────
            [
                'nombre'         => 'punto gas',
                'descripcion'    => 'Punto de gas horno de empotrar',
                'unidad'         => 'UND',
                'valor_unitario' => 250000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            // ── 20. Combo Ecoclean ───────────────────────────────────────────
            [
                'nombre'         => 'Aparatos',
                'descripcion'    => 'Combo Ecoclean Single II Negro: Sanitario con taza alongada, lavamanos con pedestal, grifería y accesorios (incrustaciones 3 piezas)',
                'unidad'         => 'UND',
                'valor_unitario' => 900000,
                'campo_usuario'  => 'num_banos',
                'link'           => 'https://corona.co/productos/sanitarios/combos-sanitarios/combo-ecoclean-single-ii-negro-sanitario-con-taza-alongada-lavamanos-con-pedestal-griferia-y-accesorios/p/501251001',
            ],
            // ── 21. Instalación Combo Ecoclean ───────────────────────────────
            [
                'nombre'         => 'Aparatos',
                'descripcion'    => 'Instalacion Combo Ecoclean Single II Negro: Sanitario con taza alongada, lavamanos con pedestal, grifería y accesorios (incrustaciones 3 piezas)',
                'unidad'         => 'UND',
                'valor_unitario' => 200000,
                'campo_usuario'  => 'num_banos',
                'link'           => null,
            ],
            // ── 22. Kit Sanitario Con Brida ──────────────────────────────────
            [
                'nombre'         => 'Aparatos',
                'descripcion'    => 'Kit  Sanitario Con Brida',
                'unidad'         => 'UND',
                'valor_unitario' => 56900,
                'campo_usuario'  => 'num_banos',
                'link'           => 'https://www.homecenter.com.co/homecenter-co/product/312220/kit-instalacion-sanitario-con-brida/312220/',
            ],
            // ── 23. Instalación kit acoflex sanitario ────────────────────────
            [
                'nombre'         => 'Aparatos',
                'descripcion'    => 'instalacion kit acoflex sanitario',
                'unidad'         => 'UND',
                'valor_unitario' => 50000,
                'campo_usuario'  => 'num_banos',
                'link'           => null,
            ],
            // ── 24. Kit acoflex lavamanos ────────────────────────────────────
            [
                'nombre'         => 'Aparatos',
                'descripcion'    => 'kit acoflex lavamanos',
                'unidad'         => 'UND',
                'valor_unitario' => 56900,
                'campo_usuario'  => 'num_banos',
                'link'           => null,
            ],
            // ── 25. Instalación kit acoflex lavamanos ────────────────────────
            [
                'nombre'         => 'Aparatos',
                'descripcion'    => 'instalacion kit acoflex lavamanos',
                'unidad'         => 'UND',
                'valor_unitario' => 50000,
                'campo_usuario'  => 'num_banos',
                'link'           => null,
            ],
            // ── 26. Lavaplatos ───────────────────────────────────────────────
            [
                'nombre'         => 'Aparatos',
                'descripcion'    => 'lavaplatos Lavaplatos Radiante de Submontar 1 Poceta 60x40 cm Acero Inoxidable Socoda',
                'unidad'         => 'UND',
                'valor_unitario' => 108900,
                'campo_usuario'  => null,  // 1 cocina, siempre 1
                'link'           => 'https://www.homecenter.com.co/homecenter-co/product/258493/lavaplatos-para-empotrar-1-poceta-53x43-cm-acero-inoxidable/258493/',
            ],
            // ── 27. Instalación Lavaplatos ───────────────────────────────────
            [
                'nombre'         => 'Aparatos',
                'descripcion'    => 'Instalacion lavaplatos Lavaplatos Radiante de Submontar 1 Poceta 60x40 cm Acero Inoxidable Socoda',
                'unidad'         => 'UND',
                'valor_unitario' => 50000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            // ── 28. Grifería Lavaplatos ──────────────────────────────────────
            [
                'nombre'         => 'griferias',
                'descripcion'    => 'Grifería Lavaplatos Sencilla Gus Mueble Negra Sensi Dacqua',
                'unidad'         => 'UND',
                'valor_unitario' => 100000,
                'campo_usuario'  => null,
                'link'           => 'https://www.homecenter.com.co/homecenter-co/product/900325/griferia-lavaplatos-sencilla-gus-mueble-negra-sensi-dacqua/900325/',
            ],
            // ── 29. Instalación Grifería Lavaplatos ──────────────────────────
            [
                'nombre'         => 'griferias',
                'descripcion'    => 'Instlacion Grifería Lavaplatos Sencilla Gus Mueble Negra Sensi Dacqua',
                'unidad'         => 'UND',
                'valor_unitario' => 50000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            // ── 30. Kit instalación lavaplatos ───────────────────────────────
            [
                'nombre'         => 'griferias',
                'descripcion'    => 'Kit De Instalación Completo Para Lavaplatos Con Canastilla 4" Pulgadas En Polimero + Sifon En P De Polimerime Gris + 2 Acoples Para Griferia De Lavaplatos De 8" Pulgadas Grival',
                'unidad'         => 'UND',
                'valor_unitario' => 58900,
                'campo_usuario'  => null,
                'link'           => 'https://www.homecenter.com.co/homecenter-co/product/138763/kit-de-instalacion-completo-para-lavaplatos-con-canastilla-4-pulgadas-en-polimero-sifon-en-p-de-polimerime-gris-2-acoples-para-griferia-de-lavaplatos-de-8-pulgadas-grival/138763/',
            ],
            // ── 31. Instalación kit lavaplatos ───────────────────────────────
            [
                'nombre'         => 'griferias',
                'descripcion'    => 'Instalacion Kit De Instalación Completo Para Lavaplatos Con Canastilla 4" Pulgadas',
                'unidad'         => 'UND',
                'valor_unitario' => 50000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
            // ── 32. Grifería Ducha ───────────────────────────────────────────
            [
                'nombre'         => 'griferias',
                'descripcion'    => 'Grifería Ducha Monocontrol Nott Negra+Regadera 25X25+Brazo Red 30 Cms',
                'unidad'         => 'UND',
                'valor_unitario' => 339900,
                'campo_usuario'  => 'num_banos',
                'link'           => 'https://www.homecenter.com.co/homecenter-co/product/721667/griferia-ducha-monocontrol-nott-negraregadera-25x25brazo-red-30-cms/721667/',
            ],
            // ── 33. Instalación Grifería Ducha ───────────────────────────────
            [
                'nombre'         => 'Duchas',
                'descripcion'    => 'Instalacion Grifería Ducha Monocontrol Nott Negra+Regadera 25X25',
                'unidad'         => 'UND',
                'valor_unitario' => 50000,
                'campo_usuario'  => 'num_banos',
                'link'           => null,
            ],
            // ── 34. Quarztone mesón cocina ───────────────────────────────────
            [
                'nombre'         => 'Quarztone',
                'descripcion'    => 'Meson de cocina en Quarztone hasta 2 m',
                'unidad'         => 'UND',
                'valor_unitario' => 1400000,
                'campo_usuario'  => null,  // siempre 1 (1 cocina)
                'link'           => null,
            ],
            // ── 35. Quarztone barra auxiliar ─────────────────────────────────
            // IMPORTANTE: en Experto esta barra es SIEMPRE 1 (cantidad fija),
            // no condicional. El CotizacionService la detecta por descripción
            // en DESCRIPCIONES_CANTIDAD_FIJA y retorna 1 independientemente
            // del flag tiene_barra_auxiliar.
            [
                'nombre'         => 'Quarztone',
                'descripcion'    => 'Meson Barra auxiliar en Quarztone (Hasta1.2m largo )',
                'unidad'         => 'UND',
                'valor_unitario' => 850000,
                'campo_usuario'  => null,  // siempre 1 en Experto (ver DESCRIPCIONES_CANTIDAD_FIJA)
                'link'           => null,
            ],
            // ── 36. Quarztone lavamanos ──────────────────────────────────────
            [
                'nombre'         => 'Quarztone',
                'descripcion'    => 'Meson Lavamanos tipo guitarra en Quarztone',
                'unidad'         => 'UND',
                'valor_unitario' => 850000,
                'campo_usuario'  => 'num_banos',
                'link'           => null,
            ],
            // ── 37. Riel Spot ────────────────────────────────────────────────
            [
                'nombre'         => 'Iluminacion',
                'descripcion'    => 'Riel Spot 3 Luces Gu10 Negro COCINA',
                'unidad'         => 'UND',
                'valor_unitario' => 179900,
                'campo_usuario'  => null,
                'link'           => 'https://www.homecenter.com.co/homecenter-co/product/511825/riel-spot-3-luces-gu10-negro/511825/',
            ],
            // ── 38. Instalación Riel Spot ────────────────────────────────────
            [
                'nombre'         => 'Iluminacion',
                'descripcion'    => 'Instalacion Riel Spot 3 Luces Gu10 Negro cocina',
                'unidad'         => 'UND',
                'valor_unitario' => 50000,
                'campo_usuario'  => null,
                'link'           => null,
            ],
        ];

        // Insertar actividades y guardar IDs
        $ids = [];
        foreach ($actividades as $data) {
            $act   = Actividad::create($data);
            $ids[] = $act->id;
        }

        // Helper 1-based
        $id = fn(int $n) => $ids[$n - 1];

        // ─── Asignaciones a propuestas ────────────────────────────────────────
        //
        // Columnas del pivot: [tipo_propuesta, actividad_id, area_base, multiplicador_m2]
        //
        // multiplicador_m2:
        //   1.0  → escala 1:1 con area_privada del usuario
        //   3.0  → escala 3:1 (muros = area_privada × 3)
        //   null → área fija (salpicadero = 15 m² fijo; todos los UND)
        //
        // area_base para m2 con multiplicador null: metros cuadrados fijos (ej: 15)
        // area_base para UND: 1 (cantidad base; el multiplicador de espacios la escala)

        $pivots = [
            // ═══════════════════════════════════
            // PROPUESTA ELEMENTAL
            // Solo pisos, muros, techos y aseo.
            // Sin carpintería ni accesorios.
            // ═══════════════════════════════════
            ['elemental', $id(1),  25, 1.0],   // Pisos suministro     (× area_privada)
            ['elemental', $id(2),  25, 1.0],   // Pisos mano obra      (× area_privada)
            ['elemental', $id(3),  75, 3.0],   // Muros estuco         (× area_privada × 3)
            ['elemental', $id(4),  15, null],  // Muros salpicadero    (15 m² fijo)
            ['elemental', $id(5),  25, 1.0],   // Techos Drywall       (× area_privada)
            ['elemental', $id(6),  25, 1.0],   // Aseo                 (× area_privada)

            // ═══════════════════════════════════
            // PROPUESTA ESTÁNDAR
            // Todo Elemental + carpintería + vidrio.
            // Sin aparatos premium ni Quarztone.
            // ═══════════════════════════════════
            ['estandar', $id(1),  25, 1.0],
            ['estandar', $id(2),  25, 1.0],
            ['estandar', $id(3),  75, 3.0],
            ['estandar', $id(4),  15, null],
            ['estandar', $id(5),  25, 1.0],
            ['estandar', $id(6),  25, 1.0],
            ['estandar', $id(7),   1, null],   // Puertas  → × num_puertas (baños+hab)
            ['estandar', $id(8),   1, null],   // Closets  → × num_habitaciones
            ['estandar', $id(9),   1, null],   // Mueble alto cocina   → condicional
            ['estandar', $id(11),  1, null],   // Barra auxiliar MDP   → condicional
            ['estandar', $id(12),  1, null],   // Mueble flotado baño  → × num_banos
            ['estandar', $id(13),  1, null],   // Mueble de ropas      (1 fijo)
            ['estandar', $id(14),  1, null],   // Campana extractora   (1 fijo)
            ['estandar', $id(15),  1, null],   // División baño        → × num_banos
            ['estandar', $id(16),  1, null],   // Espejo flotado       → × num_banos

            // ═══════════════════════════════════
            // PROPUESTA EXPERTO
            // Todo Estándar + aparatos premium + Quarztone + griferías lujo.
            //
            // Diferencias clave vs Estándar:
            //   + Mueble bajo cocina (ítem 10, siempre 1, solo Experto)
            //   + Estufa, Horno, Punto gas
            //   + Aparatos sanitarios premium (Ecoclean, Brida, Acoflex)
            //   + Lavaplatos + grifería lavaplatos + kit instalación
            //   + Griferías ducha de lujo
            //   + Quarztone mesón, barra (siempre 1), lavamanos
            //   + Riel Spot iluminación
            //   + SÍ Aseo (igual que Elemental y Estándar)
            //   + SÍ Mueble alto cocina
            //   - Barra auxiliar MDP (reemplazada por Quarztone barra)
            //   La barra Quarztone es siempre 1 (no condicional a tiene_barra_auxiliar)
            // ═══════════════════════════════════
            ['experto', $id(1),  25, 1.0],
            ['experto', $id(2),  25, 1.0],
            ['experto', $id(3),  75, 3.0],
            ['experto', $id(4),  15, null],
            ['experto', $id(5),  25, 1.0],
            ['experto', $id(6),  25, 1.0],    // Aseo ← SÍ está en Experto
            ['experto', $id(7),   1, null],   // Puertas      → × num_puertas
            ['experto', $id(8),   1, null],   // Closets      → × num_habitaciones
            ['experto', $id(9),   1, null],   // Mueble alto  ← SÍ en Experto
            ['experto', $id(10),  1, null],   // Mueble bajo  (1 fijo, exclusivo Experto)
            // ítem 11 (Barra auxiliar MDP) NO en Experto → reemplazado por Quarztone barra
            ['experto', $id(12),  1, null],   // Mueble flotado baño  → × num_banos
            ['experto', $id(13),  1, null],   // Mueble de ropas      (1 fijo)
            ['experto', $id(14),  1, null],   // Campana extractora   (1 fijo)
            ['experto', $id(15),  1, null],   // División baño        → × num_banos
            ['experto', $id(16),  1, null],   // Espejo flotado       → × num_banos
            ['experto', $id(17),  1, null],   // Estufa               (1 fijo)
            ['experto', $id(18),  1, null],   // Horno                (1 fijo)
            ['experto', $id(19),  1, null],   // Punto de gas         (1 fijo)
            ['experto', $id(20),  1, null],   // Combo Ecoclean       → × num_banos
            ['experto', $id(21),  1, null],   // Inst. Combo Ecoclean → × num_banos
            ['experto', $id(22),  1, null],   // Kit Brida            → × num_banos
            ['experto', $id(23),  1, null],   // Inst. acoflex san.   → × num_banos
            ['experto', $id(24),  1, null],   // Kit acoflex lav.     → × num_banos
            ['experto', $id(25),  1, null],   // Inst. acoflex lav.   → × num_banos
            ['experto', $id(26),  1, null],   // Lavaplatos           (1 fijo)
            ['experto', $id(27),  1, null],   // Inst. Lavaplatos     (1 fijo)
            ['experto', $id(28),  1, null],   // Grifería Lavaplatos  (1 fijo)
            ['experto', $id(29),  1, null],   // Inst. Grifería Lav.  (1 fijo)
            ['experto', $id(30),  1, null],   // Kit inst. lavaplatos (1 fijo)
            ['experto', $id(31),  1, null],   // Inst. kit lavaplatos (1 fijo)
            ['experto', $id(32),  1, null],   // Grifería Ducha       → × num_banos
            ['experto', $id(33),  1, null],   // Inst. Grifería Ducha → × num_banos
            ['experto', $id(34),  1, null],   // Quarztone mesón      (1 fijo)
            ['experto', $id(35),  1, null],   // Quarztone barra      (1 fijo - SIEMPRE 1)
            ['experto', $id(36),  1, null],   // Quarztone lavamanos  → × num_banos
            ['experto', $id(37),  1, null],   // Riel Spot            (1 fijo)
            ['experto', $id(38),  1, null],   // Inst. Riel Spot      (1 fijo)
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