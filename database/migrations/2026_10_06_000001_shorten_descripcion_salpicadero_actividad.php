<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Acorta la descripción del salpicadero/enchape (muros): quita
     * " (completo), cabina de ducha (si aplica)".
     */
    public function up(): void
    {
        DB::table('actividades')
            ->where('descripcion', 'Suministro enchape (unicas referencias) Mano de obra instalacion de ceramica salpicadero de cocina, y zona de lavadero (completo), cabina de ducha (si aplica)')
            ->update([
                'descripcion' => 'Suministro enchape (unicas referencias) Mano de obra instalacion de ceramica salpicadero de cocina, y zona de lavadero',
            ]);
    }

    public function down(): void
    {
        DB::table('actividades')
            ->where('descripcion', 'Suministro enchape (unicas referencias) Mano de obra instalacion de ceramica salpicadero de cocina, y zona de lavadero')
            ->update([
                'descripcion' => 'Suministro enchape (unicas referencias) Mano de obra instalacion de ceramica salpicadero de cocina, y zona de lavadero (completo), cabina de ducha (si aplica)',
            ]);
    }
};
