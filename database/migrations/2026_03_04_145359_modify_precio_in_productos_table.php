<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('productos', function (Blueprint $table) {

            // Permite números extremadamente grandes
            // 20 dígitos totales, 2 decimales
            // Soporta hasta 999,999,999,999,999,999.99
            $table->decimal('precio', 20, 2)->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {

            // Valor anterior típico (puedes ajustarlo si era diferente)
            $table->decimal('precio', 8, 2)->change();

        });
    }
};