<?php

use Database\Seeders\ActividadSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Añade columna es_bonus a propuesta_actividades y re-sincroniza el catálogo.
     *
     * es_bonus marca ítems que se muestran al cliente como "Bonus Track" (regalo
     * de la línea) en la vista, en un modal aparte del desglose principal.
     * El costo sigue sumando al subtotal (matches Excel).
     *
     * Ejemplo (Elemental): "Muros salpicadero" y "División baño en vidrio" son
     * bonos que no aparecen en el desglose sino en el botón Bonus Track.
     */
    public function up(): void
    {
        if (! Schema::hasColumn('propuesta_actividades', 'es_bonus')) {
            Schema::table('propuesta_actividades', function (Blueprint $table) {
                $table->boolean('es_bonus')
                    ->default(false)
                    ->after('valor_unitario_override');
            });
        }

        (new ActividadSeeder)->run();
    }

    public function down(): void
    {
        if (Schema::hasColumn('propuesta_actividades', 'es_bonus')) {
            Schema::table('propuesta_actividades', function (Blueprint $table) {
                $table->dropColumn('es_bonus');
            });
        }
    }
};
