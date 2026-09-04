<?php

namespace Database\Seeders;

use App\Models\Actividad;
use App\Models\PropuestaActividad;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

/**
 * Fuente de verdad: santiago 02-09-26.xlsx (raíz del proyecto).
 *
 * REFERENCIA DE VERIFICACIÓN (Excel escenario oficial, 32 m² · 2 habs · 1 baño):
 *   Maestro   → subtotal aprox 7.160.000 (sin AIU) — no verificado en este escenario
 *   Elemental → subtotal=$16.602.530 → VR=$19.883.190 → $621.350/m²
 *   Estándar  → subtotal=$27.052.530 → VR=$32.398.110 → $1.012.441/m²
 *   Experto   → subtotal=$37.538.930 → VR=$44.956.623 → $1.404.894/m²
 *
 * AIU (elemental/estándar/experto, no aplica en maestro):
 *   Admón 12% + Imprevistos 3% + Utilidad 4% + IVA 19% sobre utilidad
 *
 * LÓGICA DE CANTIDADES (ver CotizacionService):
 *   - Actividad m² con multiplicador_m2 => area_privada × multiplicador_m2
 *   - Actividad m² sin multiplicador_m2 => area_base (fija en m²)
 *   - Actividad UND: cantidad = area_base × factor(campo_usuario)
 *     campo_usuario ∈ { null | num_banos | num_habitaciones | num_puertas }
 *
 * REGLA DE UNIDADES POR CATEGORÍA (Excel):
 *   - Cocina                → 1 (fija) – mueble alto/bajo, barra, campana,
 *                              lavaplatos, estufa, horno, mesones Quarztone…
 *   - Cuarto de ropas       → 1 (fija)
 *   - Habitación            → num_habitaciones (closet)
 *   - Baño                  → num_banos (división, espejo, sanitario, ducha,
 *                              enchape baño completo, mueble flotado…)
 *   - Puertas alcoba        → num_habitaciones + num_banos (único ítem compartido)
 *   - Puerta lavandería     → 1 (fija) — item separado
 *   - Salpicadero (m²)      → 30 m² fijos (área NO escala con area_privada)
 *   - Muros estuco (m²)     → 3 × area_privada
 *   - Pisos/Techos/Aseo (m²)→ 1 × area_privada
 *
 * BONUS TRACK (es_bonus=true):
 *   Aparecen en el modal Bonus Track como regalo de la línea.
 *     - Elemental: Salpicadero (SÍ suma) + División de baño (SÍ suma)
 *     - Estándar:  Barra auxiliar de cocina (SÍ suma)
 *                  + Campana extractora (regalo, valor 0 → NO suma)
 *     - Experto:   (ninguno; todo va en el desglose principal)
 */
class ActividadSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        PropuestaActividad::truncate();
        Actividad::truncate();
        Schema::enableForeignKeyConstraints();

        // ─── Catálogo de actividades (orden = id 1..N) ────────────────────
        $actividades = [
            // ─── 1. Pisos suministro ─────────────────────────────────────
            [
                'nombre' => 'Pisos',
                'descripcion' => 'Suministro e instalación piso , nivelacion y cargue de pisos en mortero',
                'unidad' => 'm2',
                'valor_unitario' => 50000,
                'campo_usuario' => null,
                'link' => null,
            ],
            // ─── 2. Pisos SPC ────────────────────────────────────────────
            [
                'nombre' => 'Pisos',
                'descripcion' => 'Suminostro e instalacion piso SPC incluye guarda escobas',
                'unidad' => 'm2',
                'valor_unitario' => 94470,
                'campo_usuario' => null,
                'link' => null,
            ],
            // ─── 3. Muros estuco + pintura ──────────────────────────────
            [
                'nombre' => 'Muros',
                'descripcion' => 'Suministro e instalacion de materiales para nivelacion de paredes, estuco y pintura blnaca a 3 manos',
                'unidad' => 'm2',
                'valor_unitario' => 37050,
                'campo_usuario' => null,
                'link' => null,
            ],
            // ─── 4. Muros salpicadero (enchape cocina / lavadero / ducha) ─
            [
                'nombre' => 'Muros',
                'descripcion' => 'Suministro enchape (unicas referencias) Mano de obra instalacion de ceramica salpicadero de cocina, y zona de lavadero (completo), cabina de ducha (si aplica)',
                'unidad' => 'm2',
                'valor_unitario' => 85023,
                'campo_usuario' => null,
                'link' => null,
            ],
            // ─── 5. Techos Drywall ──────────────────────────────────────
            [
                'nombre' => 'Techos',
                'descripcion' => 'Suministro e Instalacion Drywall plano masillado y pintura a 2 manos con dilatacion perimetral. Lamina Drywall RH en baño. Cambio Iluminacion LED según diseño',
                'unidad' => 'm2',
                'valor_unitario' => 140250,
                'campo_usuario' => null,
                'link' => null,
            ],
            // ─── 6. Aseo final ──────────────────────────────────────────
            [
                'nombre' => 'Aseo',
                'descripcion' => 'Aseo final- Retiro de escombros a punto de acopio',
                'unidad' => 'm2',
                'valor_unitario' => 12000,
                'campo_usuario' => null,
                'link' => null,
            ],
            // ─── 7. Enchape baño completo (Experto: × num_banos) ────────
            //  Excel Experto R21=1, T21=1.235.000 (para 1 baño). Es UND (por baño).
            [
                'nombre' => 'Muros',
                'descripcion' => 'Suministro enchape (unicas referencias) Mano de obra instalacion de ceramica Baño completo',
                'unidad' => 'UND',
                'valor_unitario' => 1235000,
                'campo_usuario' => 'num_banos',
                'link' => null,
            ],
            // ─── 8. Puertas alcoba (× num_habitaciones + 1) ─────────────
            //  El "+1" cubre la puerta principal / lavandería. Excel calibrado
            //  para 2 habs → 3 puertas.
            [
                'nombre' => 'Madera',
                'descripcion' => 'Puertas en madera para alcoba en aglomerado MDP',
                'unidad' => 'UND',
                'valor_unitario' => 800000,
                'campo_usuario' => 'num_puertas',
                'link' => null,
            ],
            // ─── 9. Closet habitaciones (× num_habitaciones) ────────────
            [
                'nombre' => 'Madera',
                'descripcion' => 'closet habitaciones en aglomerado MDP 15mm (hasta 2 m largo)',
                'unidad' => 'UND',
                'valor_unitario' => 1800000,
                'campo_usuario' => 'num_habitaciones',
                'link' => null,
            ],
            // ─── 10. Mueble alto cocina (fija=1) ────────────────────────
            [
                'nombre' => 'Madera',
                'descripcion' => 'Mueble alto de cocina MDP RH 18mm (hasta 2 m largo)',
                'unidad' => 'UND',
                'valor_unitario' => 1600000,
                'campo_usuario' => null,
                'link' => null,
            ],
            // ─── 11. Mueble bajo cocina (solo Experto, fija=1) ──────────
            [
                'nombre' => 'Madera',
                'descripcion' => 'Mueble alto- Mueble bajo de cocina MDP RH 18mm (hasta 2 m largo)',
                'unidad' => 'UND',
                'valor_unitario' => 1600000,
                'campo_usuario' => null,
                'link' => null,
            ],
            // ─── 12. Barra auxiliar cocina MDP (solo Estándar, fija=1) ──
            [
                'nombre' => 'Madera',
                'descripcion' => 'Barra auxiliar de cocina en aglomerado MDP 15mm (Hasta1.2m largo )',
                'unidad' => 'UND',
                'valor_unitario' => 850000,
                'campo_usuario' => null,
                'link' => null,
            ],
            // ─── 13. Mueble flotado de baño (× num_banos) ───────────────
            [
                'nombre' => 'Madera',
                'descripcion' => 'Mueble flotado de Baño aglomerado MDP 15mm',
                'unidad' => 'UND',
                'valor_unitario' => 500000,
                'campo_usuario' => 'num_banos',
                'link' => null,
            ],
            // ─── 14. Mueble de ropas (fija=1) ───────────────────────────
            [
                'nombre' => 'Madera',
                'descripcion' => 'Mueble de ropas aglomerado MDP 15mm',
                'unidad' => 'UND',
                'valor_unitario' => 500000,
                'campo_usuario' => null,
                'link' => null,
            ],
            // ─── 15. Campana extractora (fija=1) ────────────────────────
            [
                'nombre' => 'Electrodomesticos',
                'descripcion' => 'Campana extractora 60 cms 3 velocidades 210M3/H CM60',
                'unidad' => 'UND',
                'valor_unitario' => 300000,
                'campo_usuario' => null,
                'link' => 'https://www.homecenter.com.co/homecenter-co/search?Ntt=campana%20extractora%20cocina',
            ],
            // ─── 16. División baño vidrio (× num_banos) ─────────────────
            [
                'nombre' => 'Vidrio',
                'descripcion' => 'Division de Baño en vidrio templado con herrajes en acero inoxidable',
                'unidad' => 'UND',
                'valor_unitario' => 1000000,
                'campo_usuario' => 'num_banos',
                'link' => null,
            ],
            // ─── 17. Espejo flotado (× num_banos) ───────────────────────
            [
                'nombre' => 'Vidrio',
                'descripcion' => 'Espejo flotado 4 mm + luz led',
                'unidad' => 'UND',
                'valor_unitario' => 500000,
                'campo_usuario' => 'num_banos',
                'link' => null,
            ],
            // ─── 18. Estufa empotrar (fija=1) ───────────────────────────
            [
                'nombre' => 'Electrodomesticos',
                'descripcion' => 'Estufa de empotrar Gas natural 4 puestos en vidrio PM6046V0 templado + instalacion',
                'unidad' => 'UND',
                'valor_unitario' => 1000000,
                'campo_usuario' => null,
                'link' => 'https://www.homecenter.com.co/homecenter-co/product/507572/estufa-de-empotrar-a-gas-60-x-43-cm-vidrio-pm6046v0/507572/',
            ],
            // ─── 19. Horno empotrar (fija=1) ────────────────────────────
            [
                'nombre' => 'Electrodomesticos',
                'descripcion' => 'Horno de Empotrar 60 cm Mixto 110 V Gas Natural Inoxidable Negro H60EEVAL005',
                'unidad' => 'UND',
                'valor_unitario' => 1000000,
                'campo_usuario' => null,
                'link' => 'https://www.homecenter.com.co/homecenter-co/product/706690/horno-de-empotrar-60-cm-mixto-110-v-gas-natural-inoxidable-negro-h60eeval005/706690/',
            ],
            // ─── 20. Punto de gas horno (fija=1) ────────────────────────
            [
                'nombre' => 'punto gas',
                'descripcion' => 'Punto de gas horno de empotrar',
                'unidad' => 'UND',
                'valor_unitario' => 250000,
                'campo_usuario' => null,
                'link' => null,
            ],
            // ─── 21. Kit Sanitario Smart Corona (× baños) ───────────────
            [
                'nombre' => 'Aparatos',
                'descripcion' => 'Sanitario Smart Alongado Single Blanco Corona.- Kit Lavamanos Sobreponer Bowl 37 Diam Vessel + Grifería Agua Fria Acero Inox - Kit Accesorios Baño Grazia Negro Percha+Portarr+Toallero',
                'unidad' => 'UND',
                'valor_unitario' => 900000,
                'campo_usuario' => 'num_banos',
                'link' => 'https://www.homecenter.com.co/homecenter-co/product/468303/sanitario-smart-alongado-single-blanco-corona/468303/',
            ],
            // ─── 22. Instalación Kit Sanitario Smart (× baños) ──────────
            [
                'nombre' => 'Aparatos',
                'descripcion' => 'Instalacion Sanitario Smart Alongado Single Blanco Corona.- Kit Lavamanos Sobreponer Bowl 37 Diam Vessel + Grifería Agua Fria Acero Inox - Kit Accesorios Baño Grazia Negro Percha+Portarr+Toallero',
                'unidad' => 'UND',
                'valor_unitario' => 200000,
                'campo_usuario' => 'num_banos',
                'link' => null,
            ],
            // ─── 23. Kit sanitario con brida (× baños) ──────────────────
            [
                'nombre' => 'Aparatos',
                'descripcion' => 'Kit Sanitario Con Brida',
                'unidad' => 'UND',
                'valor_unitario' => 56900,
                'campo_usuario' => 'num_banos',
                'link' => 'https://www.homecenter.com.co/homecenter-co/product/312220/kit-instalacion-sanitario-con-brida/312220/',
            ],
            // ─── 24. Instalación kit acoflex sanitario (× baños) ────────
            [
                'nombre' => 'Aparatos',
                'descripcion' => 'instalacion kit acoflex sanitario',
                'unidad' => 'UND',
                'valor_unitario' => 50000,
                'campo_usuario' => 'num_banos',
                'link' => null,
            ],
            // ─── 25. Kit acoflex lavamanos (× baños) ────────────────────
            [
                'nombre' => 'Aparatos',
                'descripcion' => 'kit acoflex lavamanos',
                'unidad' => 'UND',
                'valor_unitario' => 56900,
                'campo_usuario' => 'num_banos',
                'link' => null,
            ],
            // ─── 26. Instalación kit acoflex lavamanos (× baños) ────────
            [
                'nombre' => 'Aparatos',
                'descripcion' => 'instalacion kit acoflex lavamanos',
                'unidad' => 'UND',
                'valor_unitario' => 50000,
                'campo_usuario' => 'num_banos',
                'link' => null,
            ],
            // ─── 27. Lavaplatos radiante (fija=1) ───────────────────────
            [
                'nombre' => 'Aparatos',
                'descripcion' => 'lavaplatos Lavaplatos Radiante de Submontar 1 Poceta 60x40 cm Acero Inoxidable Socoda',
                'unidad' => 'UND',
                'valor_unitario' => 108900,
                'campo_usuario' => null,
                'link' => 'https://www.homecenter.com.co/homecenter-co/product/321565/lavaplatos-radiante-de-submontar-1-poceta-60x40-cm-acero-inoxidable-socoda/321565/',
            ],
            // ─── 28. Instalación lavaplatos (fija=1) ────────────────────
            [
                'nombre' => 'Aparatos',
                'descripcion' => 'Instalacion lavaplatos Lavaplatos Radiante de Submontar 1 Poceta 60x40 cm Acero Inoxidable Socoda',
                'unidad' => 'UND',
                'valor_unitario' => 50000,
                'campo_usuario' => null,
                'link' => null,
            ],
            // ─── 29. Grifería lavaplatos (fija=1) ───────────────────────
            [
                'nombre' => 'griferias',
                'descripcion' => 'Grifería Lavaplatos Sencilla Gus Mueble Negra Sensi Dacqua',
                'unidad' => 'UND',
                'valor_unitario' => 100000,
                'campo_usuario' => null,
                'link' => 'https://www.homecenter.com.co/homecenter-co/product/900325/griferia-lavaplatos-sencilla-gus-mueble-negra-sensi-dacqua/900325/',
            ],
            // ─── 30. Instalación grifería lavaplatos (fija=1) ───────────
            [
                'nombre' => 'griferias',
                'descripcion' => 'Instlacion Grifería Lavaplatos Sencilla Gus Mueble Negra Sensi Dacqua',
                'unidad' => 'UND',
                'valor_unitario' => 50000,
                'campo_usuario' => null,
                'link' => null,
            ],
            // ─── 31. Kit instalación lavaplatos (fija=1) ────────────────
            [
                'nombre' => 'griferias',
                'descripcion' => 'Kit De Instalación Completo Para Lavaplatos Con Canastilla 4" Pulgadas En Polimero + Sifon En P De Polimerime Gris + 2 Acoples Para Griferia De Lavaplatos De 8" Pulgadas Grival',
                'unidad' => 'UND',
                'valor_unitario' => 58900,
                'campo_usuario' => null,
                'link' => 'https://www.homecenter.com.co/homecenter-co/product/138763/kit-de-instalacion-completo-para-lavaplatos-con-canastilla-4-pulgadas-en-polimero-sifon-en-p-de-polimerime-gris-2-acoples-para-griferia-de-lavaplatos-de-8-pulgadas-grival/138763/',
            ],
            // ─── 32. Instalación kit lavaplatos (fija=1) ────────────────
            [
                'nombre' => 'griferias',
                'descripcion' => 'Instalacion Kit De Instalación Completo Para Lavaplatos Con Canastilla 4" Pulgadas En Polimero + Sifon En P De Polimerime Gris + 2 Acoples Para Griferia De Lavaplatos De 8" Pulgadas Grival',
                'unidad' => 'UND',
                'valor_unitario' => 50000,
                'campo_usuario' => null,
                'link' => null,
            ],
            // ─── 33. Grifería ducha (× baños) ───────────────────────────
            [
                'nombre' => 'griferias',
                'descripcion' => 'Grifería Ducha Monocontrol Nott Negra+Regadera 25X25+Brazo Red 30 Cms',
                'unidad' => 'UND',
                'valor_unitario' => 339900,
                'campo_usuario' => 'num_banos',
                'link' => 'https://www.homecenter.com.co/homecenter-co/product/721667/griferia-ducha-monocontrol-nott-negraregadera-25x25brazo-red-30-cms/721667/',
            ],
            // ─── 34. Instalación grifería ducha (× baños) ───────────────
            [
                'nombre' => 'Incrustaciones',
                'descripcion' => 'Instalacion Grifería Ducha Monocontrol Nott Negra+Regadera 25X25',
                'unidad' => 'UND',
                'valor_unitario' => 50000,
                'campo_usuario' => 'num_banos',
                'link' => null,
            ],
            // ─── 35. Mesón cocina Quarztone (fija=1) ────────────────────
            [
                'nombre' => 'Quarztone',
                'descripcion' => 'Meson de cocina en Quarztone hasta 2 m',
                'unidad' => 'UND',
                'valor_unitario' => 1400000,
                'campo_usuario' => null,
                'link' => null,
            ],
            // ─── 36. Mesón barra Quarztone (fija=1) ─────────────────────
            [
                'nombre' => 'Quarztone',
                'descripcion' => 'Meson Barra auxiliar en Quarztone (Hasta1.2m largo )',
                'unidad' => 'UND',
                'valor_unitario' => 850000,
                'campo_usuario' => null,
                'link' => null,
            ],
            // ─── 37. Mesón lavamanos Quarztone (× baños) ────────────────
            [
                'nombre' => 'Quarztone',
                'descripcion' => 'Meson Lavamanos tipo guitarra en Quarztone',
                'unidad' => 'UND',
                'valor_unitario' => 850000,
                'campo_usuario' => 'num_banos',
                'link' => null,
            ],
            // ─── 38. Riel Spot cocina (fija=1) ──────────────────────────
            [
                'nombre' => 'Iluminacion',
                'descripcion' => 'Riel Spot 3 Luces Gu10 Negro COCINA',
                'unidad' => 'UND',
                'valor_unitario' => 179900,
                'campo_usuario' => null,
                'link' => 'https://www.homecenter.com.co/homecenter-co/product/511825/riel-spot-3-luces-gu10-negro/511825/',
            ],
            // ─── 39. Instalación Riel Spot (fija=1) ─────────────────────
            [
                'nombre' => 'Iluminacion',
                'descripcion' => 'Instalacion Riel Spot 3 Luces Gu10 Negro cocina',
                'unidad' => 'UND',
                'valor_unitario' => 50000,
                'campo_usuario' => null,
                'link' => null,
            ],
            // ─── 40. Puerta lavandería (fija=1) ─────────────────────────
            //  Excel filas N23=1 (Estándar) y R23=1 (Experto). Item separado
            //  de "Puertas alcoba" (que sí escala por habs+baños).
            [
                'nombre' => 'Madera',
                'descripcion' => 'Puerta en madera zona de lavanderia',
                'unidad' => 'UND',
                'valor_unitario' => 1000000,
                'campo_usuario' => null,
                'link' => null,
            ],
        ];

        $ids = [];
        foreach ($actividades as $data) {
            $act = Actividad::create($data);
            $ids[] = $act->id;
        }

        $id = fn (int $n) => $ids[$n - 1];

        // ─── Pivots propuesta_actividades ─────────────────────────────────
        //  [tipo_propuesta, actividad_id, area_base, multiplicador_m2, override?, es_bonus?]
        //
        //   multiplicador_m2:
        //     1.0  → escala 1:1 con area_privada del usuario
        //     3.0  → escala 3:1 (muros = area_privada × 3)
        //     null → área fija (salpicadero = 15 m²; todos los UND)
        //
        //   area_base:
        //     m2 con multiplicador null → m² fijos (salpicadero=15)
        //     UND                        → 1 (multiplicador de espacios lo escala)
        //
        //   override (5º elemento, opcional): valor_unitario que reemplaza al de
        //   la actividad SOLO en esta propuesta. Lo usa Maestro.
        //
        //   es_bonus (6º elemento, opcional): si true, el ítem NO aparece en el
        //   desglose principal sino como regalo en el modal Bonus Track del
        //   cliente. Sigue sumando al subtotal.

        $pivots = [
            // ═══════════════════════════════════════════════
            // MAESTRO (sin AIU, 5 actividades básicas)
            // Ref Excel 50 m² → subtotal $10.850.000
            // ═══════════════════════════════════════════════
            ['maestro', $id(1), 1, 1.0, 25000],   // Pisos suministro   (25.000/m²)
            ['maestro', $id(2), 1, 1.0, 40000],   // Pisos SPC          (40.000/m²)
            ['maestro', $id(3), 1, 3.0, 30000],   // Muros estuco       (30.000/m² × 3)
            ['maestro', $id(4), 15, null, 40000], // Salpicadero        (40.000/m² × 15 fijo)
            ['maestro', $id(5), 1, 1.0, 50000],   // Techos Drywall     (50.000/m²)
            // Maestro NO incluye aseo.

            // ═══════════════════════════════════════════════
            // ELEMENTAL (base + Salpicadero + División de baño como bonuses).
            //   Los ítems bonus SÍ suman al subtotal, sólo se presentan al
            //   cliente en el modal Bonus Track como regalo de la línea.
            // ═══════════════════════════════════════════════
            ['elemental', $id(1),  1, 1.0],               // Pisos suministro
            ['elemental', $id(2),  1, 1.0],               // Pisos SPC
            ['elemental', $id(3),  1, 3.0],               // Muros estuco
            ['elemental', $id(4), 30, null, null, true],  // Salpicadero [BONUS] area fija 30
            ['elemental', $id(5),  1, 1.0],               // Techos
            ['elemental', $id(6),  1, 1.0],               // Aseo
            ['elemental', $id(16), 1, null, null, true],  // División baño [BONUS]

            // ═══════════════════════════════════════════════
            // ESTÁNDAR (Excel 32 m² · 2h · 1b → subtotal $27.052.530)
            //   Bonus: Barra auxiliar de cocina (SÍ suma) + Campana (regalo, valor 0).
            //   NO incluye mueble flotado de baño (N28=0 en Excel).
            // ═══════════════════════════════════════════════
            ['estandar', $id(1),  1, 1.0],
            ['estandar', $id(2),  1, 1.0],
            ['estandar', $id(3),  1, 3.0],
            ['estandar', $id(4), 30, null],  // Salpicadero area fija 30
            ['estandar', $id(5),  1, 1.0],
            ['estandar', $id(6),  1, 1.0],
            ['estandar', $id(8),  1, null],  // Puertas alcoba (× num_habs + num_banos)
            ['estandar', $id(40), 1, null],  // Puerta lavandería (fija=1, $1M)
            ['estandar', $id(9),  1, null],  // Closet (× num_habitaciones)
            ['estandar', $id(10), 1, null],  // Mueble alto cocina (fija=1)
            ['estandar', $id(12), 1, null, null, true],  // Barra auxiliar MDP [BONUS] suma
            ['estandar', $id(14), 1, null],  // Mueble ropas (fija=1)
            ['estandar', $id(15), 1, null, 0, true],  // Campana [BONUS] valor 0 (regalo)
            ['estandar', $id(16), 1, null],  // División baño (× num_banos)
            ['estandar', $id(17), 1, null],  // Espejo flotado (× num_banos)

            // ═══════════════════════════════════════════════
            // EXPERTO (Excel 32 m² · 2h · 1b → subtotal $37.538.930)
            //   Incluye enchape baño completo (× num_banos, $1.235.000).
            //   + Mueble bajo cocina fijo. + Mueble flotado baño (× num_banos).
            //   + Mesón/Barra/Lavamanos Quarztone. Campana SÍ suma ($300k fija).
            //   Barra auxiliar MDP NO se incluye (reemplazada por Barra Quarztone).
            // ═══════════════════════════════════════════════
            ['experto', $id(1),  1, 1.0],
            ['experto', $id(2),  1, 1.0],
            ['experto', $id(3),  1, 3.0],
            ['experto', $id(4), 30, null],  // Salpicadero area fija 30
            ['experto', $id(5),  1, 1.0],
            ['experto', $id(6),  1, 1.0],
            ['experto', $id(7),  1, null],  // Enchape baño completo (× num_banos)
            ['experto', $id(8),  1, null],  // Puertas alcoba (× num_habs + num_banos)
            ['experto', $id(40), 1, null],  // Puerta lavandería (fija=1, $1M)
            ['experto', $id(9),  1, null],  // Closet (× num_habitaciones)
            ['experto', $id(10), 1, null],  // Mueble alto cocina (fija=1)
            ['experto', $id(11), 1, null],  // Mueble bajo cocina (fija=1)
            ['experto', $id(13), 1, null],  // Mueble flotado baño (× num_banos)
            ['experto', $id(14), 1, null],  // Mueble ropas (fija=1)
            ['experto', $id(15), 1, null],  // Campana extractora (fija=1)
            ['experto', $id(16), 1, null],  // División baño (× num_banos)
            ['experto', $id(17), 1, null],  // Espejo (× num_banos)
            ['experto', $id(18), 1, null],  // Estufa
            ['experto', $id(19), 1, null],  // Horno
            ['experto', $id(20), 1, null],  // Punto gas
            ['experto', $id(21), 1, null],  // Kit Sanitario Smart (× baños)
            ['experto', $id(22), 1, null],  // Inst. Kit Sanitario Smart (× baños)
            ['experto', $id(23), 1, null],  // Kit brida (× baños)
            ['experto', $id(24), 1, null],  // Inst. acoflex sanitario (× baños)
            ['experto', $id(25), 1, null],  // Kit acoflex lavamanos (× baños)
            ['experto', $id(26), 1, null],  // Inst. acoflex lavamanos (× baños)
            ['experto', $id(27), 1, null],  // Lavaplatos (fija=1)
            ['experto', $id(28), 1, null],  // Inst. lavaplatos (fija=1)
            ['experto', $id(29), 1, null],  // Grifería lavaplatos (fija=1)
            ['experto', $id(30), 1, null],  // Inst. grifería lavaplatos (fija=1)
            ['experto', $id(31), 1, null],  // Kit inst. lavaplatos (fija=1)
            ['experto', $id(32), 1, null],  // Inst. kit lavaplatos (fija=1)
            ['experto', $id(33), 1, null],  // Grifería ducha (× baños)
            ['experto', $id(34), 1, null],  // Inst. grifería ducha (× baños)
            ['experto', $id(35), 1, null],  // Mesón Quarztone (fija=1)
            ['experto', $id(36), 1, null],  // Barra Quarztone (fija=1)
            ['experto', $id(37), 1, null],  // Lavamanos Quarztone (× baños)
            ['experto', $id(38), 1, null],  // Riel Spot (fija=1)
            ['experto', $id(39), 1, null],  // Inst. Riel Spot (fija=1)
        ];

        foreach ($pivots as $pivot) {
            [$tipo, $actividadId, $areaBase, $multiplicador] = $pivot;
            $override = $pivot[4] ?? null;
            $esBonus = $pivot[5] ?? false;

            PropuestaActividad::create([
                'tipo_propuesta' => $tipo,
                'actividad_id' => $actividadId,
                'area_base' => $areaBase,
                'multiplicador_m2' => $multiplicador,
                'valor_unitario_override' => $override,
                'es_bonus' => $esBonus,
            ]);
        }
    }
}
