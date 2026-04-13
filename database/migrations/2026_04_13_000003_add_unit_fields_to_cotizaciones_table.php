<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Agrega los campos de unidades al formulario de cotización.
     * Estas respuestas determinan la cantidad de los ítems UND en cada propuesta.
     */
    public function up(): void
    {
        Schema::table('cotizaciones', function (Blueprint $table) {
            $table->unsignedTinyInteger('num_puertas')->default(0)->after('area_privada');
            $table->unsignedTinyInteger('num_closets')->default(0)->after('num_puertas');
            $table->unsignedTinyInteger('num_banos')->default(1)->after('num_closets');
            $table->boolean('tiene_mueble_alto_cocina')->default(false)->after('num_banos');
            $table->boolean('tiene_barra_auxiliar')->default(false)->after('tiene_mueble_alto_cocina');
        });
    }

    public function down(): void
    {
        Schema::table('cotizaciones', function (Blueprint $table) {
            $table->dropColumn([
                'num_puertas',
                'num_closets',
                'num_banos',
                'tiene_mueble_alto_cocina',
                'tiene_barra_auxiliar',
            ]);
        });
    }
};
