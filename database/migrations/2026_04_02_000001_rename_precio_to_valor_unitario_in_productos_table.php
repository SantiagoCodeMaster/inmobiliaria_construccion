<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            // Renombramos 'precio' a 'valor_unitario' para reflejar la nueva lógica:
            // Precio Total = m² × valor_unitario
            $table->renameColumn('precio', 'valor_unitario');
        });
    }

    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->renameColumn('valor_unitario', 'precio');
        });
    }
};
