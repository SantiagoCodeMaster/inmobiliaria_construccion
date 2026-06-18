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
        Schema::create('cotizacion_actividades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cotizacion_id')->constrained('cotizaciones')->onDelete('cascade');
            $table->string('tipo_plan', 20);
            $table->string('categoria', 100);
            $table->text('descripcion');
            $table->string('unidad', 10)->default('UND');
            $table->decimal('cantidad', 10, 2)->default(1);
            $table->decimal('valor_unitario', 12, 2)->default(0);
            $table->decimal('vr_total', 14, 2)->default(0);
            $table->boolean('es_adicional')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotizacion_actividades');
    }
};
