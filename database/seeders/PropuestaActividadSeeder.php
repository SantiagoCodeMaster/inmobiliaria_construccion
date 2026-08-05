<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropuestaActividadSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('propuesta_actividades')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $actividades = DB::table('actividades')->get()->keyBy('descripcion');

        $propuestas = [];

        // =====================================================
        // MAESTRO (ECONOMICO, SIN AIU)
        // Mismas actividades que Elemental pero SIN administración,
        // imprevistos ni utilidad → el total es solo el subtotal.
        // =====================================================
        $propuestas[] = ['tipo_propuesta' => 'maestro', 'actividad_id' => $actividades['Suministro e instalación piso , nivelacion y cargue de pisos en mortero']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'maestro', 'actividad_id' => $actividades['Mano de obra instalacion de piso en ceramica y/o piso SPC incluye guarda escobas']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'maestro', 'actividad_id' => $actividades['Suministro e instalacion de materiales para nivelacion de paredes, estuco y pintura blnaca a 3 manos']->id, 'area_base' => null, 'multiplicador_m2' => 3];
        $propuestas[] = ['tipo_propuesta' => 'maestro', 'actividad_id' => $actividades['Mano de obra instalacion de ceramica salpicadero de cocina, y zona de lavadero, cabina de ducha (si aplica)']->id, 'area_base' => 15, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'maestro', 'actividad_id' => $actividades['Suministro e Instalacion Drywall plano masillado y pintura a 2 manos con dilatacion perimetral. Lamina Drywall RH en baño. Cambio  Iluminacion LED según diseño']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'maestro', 'actividad_id' => $actividades['Aseo final- Retiro de escombros a punto de acopio']->id, 'area_base' => null, 'multiplicador_m2' => null];

        // =====================================================
        // ELEMENTAL (BASICO)
        // =====================================================
        $propuestas[] = ['tipo_propuesta' => 'elemental', 'actividad_id' => $actividades['Suministro e instalación piso , nivelacion y cargue de pisos en mortero']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'elemental', 'actividad_id' => $actividades['Mano de obra instalacion de piso en ceramica y/o piso SPC incluye guarda escobas']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'elemental', 'actividad_id' => $actividades['Suministro e instalacion de materiales para nivelacion de paredes, estuco y pintura blnaca a 3 manos']->id, 'area_base' => null, 'multiplicador_m2' => 3];
        $propuestas[] = ['tipo_propuesta' => 'elemental', 'actividad_id' => $actividades['Mano de obra instalacion de ceramica salpicadero de cocina, y zona de lavadero, cabina de ducha (si aplica)']->id, 'area_base' => 15, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'elemental', 'actividad_id' => $actividades['Suministro e Instalacion Drywall plano masillado y pintura a 2 manos con dilatacion perimetral. Lamina Drywall RH en baño. Cambio  Iluminacion LED según diseño']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'elemental', 'actividad_id' => $actividades['Aseo final- Retiro de escombros a punto de acopio']->id, 'area_base' => null, 'multiplicador_m2' => null];

        // =====================================================
        // ESTANDAR (MEDIO)
        // =====================================================
        $propuestas[] = ['tipo_propuesta' => 'estandar', 'actividad_id' => $actividades['Suministro e instalación piso , nivelacion y cargue de pisos en mortero']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'estandar', 'actividad_id' => $actividades['Mano de obra instalacion de piso en ceramica y/o piso SPC incluye guarda escobas']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'estandar', 'actividad_id' => $actividades['Suministro e instalacion de materiales para nivelacion de paredes, estuco y pintura blnaca a 3 manos']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'estandar', 'actividad_id' => $actividades['Mano de obra instalacion de ceramica salpicadero de cocina, y zona de lavadero, cabina de ducha (si aplica)']->id, 'area_base' => 15, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'estandar', 'actividad_id' => $actividades['Suministro e Instalacion Drywall plano masillado y pintura a 2 manos con dilatacion perimetral. Lamina Drywall RH en baño. Cambio  Iluminacion LED según diseño']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'estandar', 'actividad_id' => $actividades['Aseo final- Retiro de escombros a punto de acopio']->id, 'area_base' => null, 'multiplicador_m2' => null];

        // Madera Estandar
        $propuestas[] = ['tipo_propuesta' => 'estandar', 'actividad_id' => $actividades['Puertas en madera para alcoba en aglomerado MDP']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'estandar', 'actividad_id' => $actividades['closet habitaciones en aglomerado MDP 15mm (hasta 2 m largo)']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'estandar', 'actividad_id' => $actividades['Mueble alto  de cocina MDP RH 18mm (hasta 2 m largo)']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'estandar', 'actividad_id' => $actividades['Barra auxiliar de cocina en aglomerado MDP 15mm (Hasta1.2m largo )']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'estandar', 'actividad_id' => $actividades['Mueble flotado de Baño  aglomerado MDP 15mm']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'estandar', 'actividad_id' => $actividades['Mueble de ropas  aglomerado MDP 15mm']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'estandar', 'actividad_id' => $actividades['campana extractora 60 cms 3 velocoidades']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'estandar', 'actividad_id' => $actividades['Division de Baño en vidrio templado con herrajes en acero inoxidable']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'estandar', 'actividad_id' => $actividades['Espejo flotado 4 mm + luz led']->id, 'area_base' => null, 'multiplicador_m2' => null];

        // =====================================================
        // EXPERTO (PLUS)
        // =====================================================
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Suministro e instalación piso , nivelacion y cargue de pisos en mortero']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Mano de obra instalacion de piso en ceramica y/o piso SPC incluye guarda escobas']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Suministro e instalacion de materiales para nivelacion de paredes, estuco y pintura blnaca a 3 manos']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Mano de obra instalacion de ceramica salpicadero de cocina, y zona de lavadero, cabina de ducha (si aplica)']->id, 'area_base' => 15, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Suministro e Instalacion Drywall plano masillado y pintura a 2 manos con dilatacion perimetral. Lamina Drywall RH en baño. Cambio  Iluminacion LED según diseño']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Aseo final- Retiro de escombros a punto de acopio']->id, 'area_base' => null, 'multiplicador_m2' => null];

        // Madera Experto
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Puertas en madera para alcoba en aglomerado MDP']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['closet habitaciones en aglomerado MDP 15mm (hasta 2 m largo)']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Mueble alto- Mueble bajo   de cocina MDP RH 18mm (hasta 2 m largo)']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Mueble flotado de Baño  aglomerado MDP 15mm']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Mueble de ropas  aglomerado MDP 15mm']->id, 'area_base' => null, 'multiplicador_m2' => null];

        // Electrodomesticos Experto
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['campana extractora 60 cms 3 velocoidades']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Estufa de empotrar Gas natural 4 puestos en vidrio templado+ instalacion']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Horno de empotrar 60 cms mixto 110v y/o Gas Natural+instalacion']->id, 'area_base' => null, 'multiplicador_m2' => null];

        // Vidrio Experto
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Division de Baño en vidrio templado con herrajes en acero inoxidable']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Espejo flotado 4 mm + luz led']->id, 'area_base' => null, 'multiplicador_m2' => null];

        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Punto de gas horno de empotrar']->id, 'area_base' => null, 'multiplicador_m2' => null];

        // Aparatos Experto
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Combo Ecoclean Single II Negro: Sanitario con taza alongada, lavamanos con pedestal, grifería y accesorios (incrustaciones 3 piezas)']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Instalacion Combo Ecoclean Single II Negro: Sanitario con taza alongada, lavamanos con pedestal, grifería y accesorios (incrustaciones 3 piezas)']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Kit  Sanitario Con Brida']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['instalacion kit acoflex sanitario']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['kit acoflex lavamanos']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['instalacion kit acoflex lavamanos']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['lavaplatos Lavaplatos Radiante de Submontar 1 Poceta 60x40 cm Acero Inoxidable Socoda']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Instalacion lavaplatos Lavaplatos Radiante de Submontar 1 Poceta 60x40 cm Acero Inoxidable Socoda']->id, 'area_base' => null, 'multiplicador_m2' => null];

        // Griferias Experto
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Grifería Lavaplatos Sencilla Gus Mueble Negra Sensi Dacqua']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Instlacion Grifería Lavaplatos Sencilla Gus Mueble Negra Sensi Dacqua']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Kit De Instalación Completo Para Lavaplatos Con Canastilla 4" Pulgadas En Polimero + Sifon En P De Polimerime Gris + 2 Acoples Para Griferia De Lavaplatos De 8" Pulgadas Grival']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Instalacion Kit De Instalación Completo Para Lavaplatos Con Canastilla 4" Pulgadas En Polimero + Sifon En P De Polimerime Gris + 2 Acoples Para Griferia De Lavaplatos De 8" Pulgadas Grival']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Grifería Ducha Monocontrol Nott Negra+Regadera 25X25+Brazo Red 30 Cms']->id, 'area_base' => null, 'multiplicador_m2' => null];

        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Instalacion Grifería Ducha Monocontrol Nott Negra+Regadera 25X25']->id, 'area_base' => null, 'multiplicador_m2' => null];

        // QUARZTONE (CRITICO)
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Meson de cocina en Quarztone hasta 2 m']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Meson Barra auxiliar en Quarztone (Hasta1.2m largo )']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Meson Lavamanos tipo guitarra en Quarztone']->id, 'area_base' => null, 'multiplicador_m2' => null];

        // Iluminacion Experto
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Riel Spot 3 Luces Gu10 Negro COCINA']->id, 'area_base' => null, 'multiplicador_m2' => null];
        $propuestas[] = ['tipo_propuesta' => 'experto', 'actividad_id' => $actividades['Instalacion Riel Spot 3 Luces Gu10 Negro cocina']->id, 'area_base' => null, 'multiplicador_m2' => null];

        foreach ($propuestas as $propuesta) {
            DB::table('propuesta_actividades')->insert($propuesta);
        }
    }
}
