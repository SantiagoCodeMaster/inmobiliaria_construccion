<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Agrega el tipo de propuesta "maestro" al enum de la tabla
     * propuesta_actividades (plan económico sin administración,
     * imprevistos ni utilidad).
     */
    public function up(): void
    {
        Schema::table('propuesta_actividades', function (Blueprint $table) {
            $table->enum('tipo_propuesta', ['elemental', 'estandar', 'experto', 'maestro'])->change();
        });
    }

    public function down(): void
    {
        Schema::table('propuesta_actividades', function (Blueprint $table) {
            $table->enum('tipo_propuesta', ['elemental', 'estandar', 'experto'])->change();
        });
    }
};