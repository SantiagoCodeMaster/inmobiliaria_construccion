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
        Schema::create('productos', function (Blueprint $table) {
            // Define 'id_producto' como llave primaria autoincrementable
            $table->id('id_producto'); 
            
            // Columnas solicitadas
            $table->string('tipo_obra');
            $table->string('planes'); // Puedes cambiar 'string' a 'text' si este campo almacenará mucho texto
            $table->decimal('precio', 10, 2); // Formato decimal para el precio (ej: 99999999.99)
            
            // Crea automáticamente las columnas 'created_at' y 'updated_at'
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};