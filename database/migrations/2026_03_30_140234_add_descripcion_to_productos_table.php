<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecutar las migraciones.
     */
    public function up(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            // Se usa longText para textos muy largos sin un límite estándar estricto.
            // Se coloca nullable() para que no falle con los registros ya creados.
            $table->longText('descripcion')->nullable()->after('planes');
        });
    }

    /**
     * Revertir las migraciones.
     */
    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            // Elimina la columna si haces un rollback
            $table->dropColumn('descripcion');
        });
    }
};