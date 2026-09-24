<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Mueve el salpicadero/enchape (muros) de la línea elemental del
     * Bonus Track al desglose principal (detalle).
     *
     * En producción la migración 2026_09_04 ya había corrido con
     * es_bonus=1, así que este UPDATE es el que aplica el cambio real.
     */
    public function up(): void
    {
        DB::table('propuesta_actividades as pa')
            ->join('actividades as a', 'pa.actividad_id', '=', 'a.id')
            ->where('pa.tipo_propuesta', 'elemental')
            ->where('a.descripcion', 'like', '%salpicadero%')
            ->update(['pa.es_bonus' => false]);
    }

    public function down(): void
    {
        DB::table('propuesta_actividades as pa')
            ->join('actividades as a', 'pa.actividad_id', '=', 'a.id')
            ->where('pa.tipo_propuesta', 'elemental')
            ->where('a.descripcion', 'like', '%salpicadero%')
            ->update(['pa.es_bonus' => true]);
    }
};
