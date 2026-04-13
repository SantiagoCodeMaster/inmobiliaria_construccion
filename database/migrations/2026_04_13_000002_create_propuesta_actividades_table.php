<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabla pivote que define qué actividades pertenecen a cada propuesta
     * y cómo escalan con el área del apartamento.
     *
     * Lógica de cálculo (unidad = m2):
     *   - Si multiplicador_m2 IS NOT NULL: cantidad = area_privada_usuario * multiplicador_m2
     *   - Si multiplicador_m2 IS NULL    : cantidad = area_base (valor fijo en m²)
     *
     * Lógica de cálculo (unidad = UND):
     *   - Siempre usa area_base, EXCEPTO si la actividad tiene campo_usuario definido,
     *     en cuyo caso la cantidad viene del campo del formulario del usuario.
     */
    public function up(): void
    {
        Schema::create('propuesta_actividades', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo_propuesta', ['elemental', 'estandar', 'experto']);
            $table->foreignId('actividad_id')->constrained('actividades')->cascadeOnDelete();
            // Para m2: cantidad base a 25 m² de referencia (ej. 25, 75, 15)
            // Para UND: cantidad fija (generalmente 1)
            $table->decimal('area_base', 10, 2)->default(1);
            // Solo aplica a actividades m2.
            // null  = área fija (no escala con m² del usuario)
            // 1.0   = escala 1:1 con m² (pisos, techos, aseo)
            // 3.0   = escala 3:1 con m² (muros de estuco = 3 * area_privada)
            $table->decimal('multiplicador_m2', 8, 4)->nullable();
            $table->timestamps();

            $table->index(['tipo_propuesta', 'actividad_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('propuesta_actividades');
    }
};
