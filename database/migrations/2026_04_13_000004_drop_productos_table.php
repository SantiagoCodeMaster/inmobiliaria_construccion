<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('productos');
    }

    public function down(): void
    {
        // Recrear la tabla si se hace rollback
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id_producto');
            $table->string('tipo_obra');
            $table->string('planes');
            $table->longText('descripcion')->nullable();
            $table->decimal('valor_unitario', 20, 2);
            $table->timestamps();
        });
    }
};
