<?php

use Database\Seeders\ActividadSeeder;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Re-sincroniza actividades + propuesta_actividades con MODELODEPRECIOS.xlsx.
     * Ajustes: precios m² (estuco, salpicadero, techos), agrega mueble flotado
     * de baño + campana extractora, quita puerta lavandería + división baño en
     * elemental, cambia área salpicadero a 15 m² y fórmula puertas a habs+1.
     * El seeder trunca ambas tablas y reinserta el catálogo alineado al Excel.
     */
    public function up(): void
    {
        (new ActividadSeeder)->run();
    }

    public function down(): void
    {
        // No hay rollback: la fuente de verdad es el Excel actual.
    }
};
