<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Crea la línea "light": la más económica con AIU.
     *
     * Es la Elemental pero SIN el piso SPC, SIN el bono de división de baño y
     * con tres cambios de acabado:
     *   - Techos  → "ALISDA Y PINTURA DE TECHOS" (70.000/m²) en vez de Drywall
     *   - Enchape → línea básica por m² (100.000/m² × área)
     *   - Baño    → combo sanitario nova (600.000 × num_banos)
     *
     * Escenario de referencia 63 m² · 1 baño → subtotal $24.769.140.
     */
    public function up(): void
    {
        $enchape = $this->actividad(
            'PISOS APTO (linea economica)',
            'Suministro enchape (únicas referencias- línea básica ) e instalación de enchape para salpicadero de cocina- cabina de ducha - y una tableta alrededor de lavadero.',
            'm2',
            100000,
            null
        );

        $techos = $this->actividad('TECHOS', 'ALISDA Y PINTURA DE TECHOS', 'm2', 70000, null);

        $bano = $this->actividad(
            'baño',
            'El combo sanitario nova (lavamano- sanitario basico) y accesorios',
            'UND',
            600000,
            'num_banos'
        );

        $pivots = [
            // [descripcion de la actividad, area_base, multiplicador_m2]
            [$this->id('Suministro e instalación piso , nivelacion y cargue de pisos en mortero'), 1, 1.0],
            [$this->id('Suministro e instalacion de materiales para nivelacion de paredes, estuco y pintura blnaca a 3 manos'), 1, 3.0],
            [$this->id('Suministro enchape (unicas referencias) Mano de obra instalacion de ceramica salpicadero de cocina, y zona de lavadero'), 30, null],
            [$this->id('Aseo final- Retiro de escombros a punto de acopio'), 1, 1.0],
            [$enchape, 1, 1.0],
            [$techos, 1, 1.0],
            [$bano, 1, null],
        ];

        foreach ($pivots as [$actividadId, $areaBase, $multiplicador]) {
            if (! $actividadId) {
                continue;
            }

            DB::table('propuesta_actividades')->updateOrInsert(
                ['tipo_propuesta' => 'light', 'actividad_id' => $actividadId],
                [
                    'area_base' => $areaBase,
                    'multiplicador_m2' => $multiplicador,
                    'valor_unitario_override' => null,
                    'es_bonus' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }

    public function down(): void
    {
        DB::table('propuesta_actividades')->where('tipo_propuesta', 'light')->delete();

        DB::table('actividades')->whereIn('descripcion', [
            'Suministro enchape (únicas referencias- línea básica ) e instalación de enchape para salpicadero de cocina- cabina de ducha - y una tableta alrededor de lavadero.',
            'ALISDA Y PINTURA DE TECHOS',
            'El combo sanitario nova (lavamano- sanitario basico) y accesorios',
        ])->delete();
    }

    private function actividad(string $nombre, string $descripcion, string $unidad, int $valor, ?string $campo): int
    {
        $existente = DB::table('actividades')->where('descripcion', $descripcion)->value('id');

        if ($existente) {
            return (int) $existente;
        }

        return (int) DB::table('actividades')->insertGetId([
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'unidad' => $unidad,
            'valor_unitario' => $valor,
            'campo_usuario' => $campo,
            'link' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function id(string $descripcion): ?int
    {
        $id = DB::table('actividades')->where('descripcion', $descripcion)->value('id');

        return $id ? (int) $id : null;
    }
};
