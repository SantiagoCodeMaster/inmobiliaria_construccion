<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Eliminar actividades de madera que no pertenecen a la línea experto.
        // En experto, el mesón de cocina y barra auxiliar son Quarztone, no madera.
        // Actividad 9: Mueble alto de cocina MDP RH 18mm
        // Actividad 10: Mueble alto- Mueble bajo de cocina MDP RH 18mm
        DB::table('propuesta_actividades')
            ->where('tipo_propuesta', 'experto')
            ->whereIn('actividad_id', [9, 10])
            ->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Restaurar las actividades de madera en el plan experto
        $maderaActivities = [9, 10];
        foreach ($maderaActivities as $actividadId) {
            DB::table('propuesta_actividades')->insert([
                'tipo_propuesta' => 'experto',
                'actividad_id' => $actividadId,
                'area_base' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
};
