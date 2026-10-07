<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Agrega "light" al enum de tipo_propuesta.
     *
     * Va ANTES de las migraciones 2026_09_03 / 2026_09_04 porque éstas
     * re-ejecutan ActividadSeeder, que ya inserta pivots de la línea light.
     */
    public function up(): void
    {
        Schema::table('propuesta_actividades', function (Blueprint $table) {
            $table->enum('tipo_propuesta', ['elemental', 'estandar', 'experto', 'maestro', 'light'])->change();
        });
    }

    public function down(): void
    {
        DB::table('propuesta_actividades')->where('tipo_propuesta', 'light')->delete();

        Schema::table('propuesta_actividades', function (Blueprint $table) {
            $table->enum('tipo_propuesta', ['elemental', 'estandar', 'experto', 'maestro'])->change();
        });
    }
};
