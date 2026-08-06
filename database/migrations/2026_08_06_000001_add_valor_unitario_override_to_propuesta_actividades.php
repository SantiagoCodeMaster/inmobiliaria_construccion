<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Permite sobrescribir el valor_unitario de una actividad para una
     * propuesta específica. Usado principalmente por MAESTRO, que utiliza
     * precios más bajos que Elemental/Estándar/Experto en las mismas
     * actividades m² (pisos, muros, techos).
     *
     * Si valor_unitario_override es NULL, se usa el valor_unitario de la
     * actividad. Si tiene valor, ese valor reemplaza al de la actividad
     * solo para esta propuesta.
     */
    public function up(): void
    {
        Schema::table('propuesta_actividades', function (Blueprint $table) {
            $table->decimal('valor_unitario_override', 12, 2)->nullable()->after('multiplicador_m2');
        });
    }

    public function down(): void
    {
        Schema::table('propuesta_actividades', function (Blueprint $table) {
            $table->dropColumn('valor_unitario_override');
        });
    }
};
