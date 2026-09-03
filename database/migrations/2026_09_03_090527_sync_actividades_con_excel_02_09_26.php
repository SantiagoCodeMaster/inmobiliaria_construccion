<?php

use Database\Seeders\ActividadSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Sincroniza actividades + propuesta_actividades con santiago 02-09-26.xlsx.
     * Cambios de negocio (bajaron precios, se agregaron/reemplazaron items).
     * El seeder trunca ambas tablas y reinserta el catálogo alineado al Excel.
     * cotizacion_actividades (personalizaciones por cotización) no se toca.
     *
     * Asegura primero la columna es_bonus (idempotente): el seeder la usa al
     * insertar pivots, y en instalaciones nuevas la migración de columna corre
     * después (misma fecha) — este check evita fallar por columna faltante.
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
        // No hay rollback: los precios/actividades anteriores quedaron obsoletos
        // (fuente de verdad = Excel 02-09-26). Restaurar el estado previo
        // requeriría un seeder histórico que ya no refleja el negocio.
    }
};
