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
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id();
            
            // Datos personales
            $table->string('nombre', 255);
            $table->string('apellido', 255);
            $table->string('email', 255);
            $table->string('telefono', 20);
            
            // Datos de la obra/cotización
            $table->string('tipo_obra')->nullable();
            $table->decimal('area_privada', 10, 2)->nullable();
            $table->string('nombre_proyecto', 255)->nullable();
            $table->date('fecha_entrega')->nullable();
            
            // Timestamps
            $table->timestamps();
            
            // Índices para mejorar búsquedas
            $table->index('email');
            $table->index('telefono');
            $table->index('nombre_proyecto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotizaciones');
    }
};