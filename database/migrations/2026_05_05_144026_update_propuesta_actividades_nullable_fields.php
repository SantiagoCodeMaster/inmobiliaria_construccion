<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('propuesta_actividades', function (Blueprint $table) {
            // Permitir valores NULL en estas columnas
            $table->decimal('area_base', 10, 2)->nullable()->change();
            $table->decimal('multiplicador_m2', 8, 2)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('propuesta_actividades', function (Blueprint $table) {
            $table->decimal('area_base', 10, 2)->nullable(false)->change();
            $table->decimal('multiplicador_m2', 8, 2)->nullable(false)->change();
        });
    }
};