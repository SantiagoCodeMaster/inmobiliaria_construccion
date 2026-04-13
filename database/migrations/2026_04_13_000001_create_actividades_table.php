<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');          // Categoría: Pisos, Muros, Techos, Madera…
            $table->text('descripcion');       // Descripción detallada de la actividad
            $table->enum('unidad', ['m2', 'UND']); // Metro cuadrado o Unidad
            $table->decimal('valor_unitario', 20, 2); // Precio por m² o por unidad
            // Campo que enlaza la cantidad de esta actividad UND con el dato del usuario
            // null = cantidad fija (usa area_base del pivot), o uno de:
            // 'num_puertas', 'num_closets', 'num_banos',
            // 'tiene_mueble_alto_cocina', 'tiene_barra_auxiliar'
            $table->string('campo_usuario', 100)->nullable();
            $table->string('link', 500)->nullable(); // Enlace de referencia (Homecenter, etc.)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('actividades');
    }
};
