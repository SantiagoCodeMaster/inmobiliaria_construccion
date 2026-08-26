<?php

namespace App\Http\Controllers;

use App\Models\Actividad;

class RemodelacionViviendaUsadaController extends Controller
{
    public function index()
    {
        $actividades = Actividad::orderBy('nombre')->get();

        $categorizadas = [
            'bano' => [],
            'cocina' => [],
            'habitaciones' => [],
        ];

        foreach ($actividades as $act) {
            foreach ($this->clasificar($act) as $cat) {
                $categorizadas[$cat][] = [
                    'id' => $act->id,
                    'categoria' => $act->nombre,
                    'descripcion' => $act->descripcion,
                    'unidad' => $act->unidad,
                    'cantidad' => 0,
                    'valor_unitario' => (int) round($act->valor_unitario),
                    'vr_total' => 0,
                    'es_adicional' => false,
                ];
            }
        }

        $catalogo = $actividades->map(fn ($a) => [
            'id' => $a->id,
            'nombre' => $a->nombre,
            'descripcion' => $a->descripcion,
            'unidad' => $a->unidad,
            'valor_unitario' => (int) round($a->valor_unitario),
        ])->values()->all();

        return view('remodelacion-vivienda-usada', compact('categorizadas', 'catalogo'));
    }

    private function n(string $s): string
    {
        return mb_strtolower($s, 'UTF-8');
    }

    private function clasificar(Actividad $act): array
    {
        $t = $this->n($act->nombre.' '.$act->descripcion);
        $cats = [];

        $isPuerta = str_contains($t, 'puerta');
        $isCocina = str_contains($t, 'lavaplatos')
            || (str_contains($t, 'griferia') && str_contains($t, 'lavaplatos'))
            || str_contains($t, 'sencilla gus')
            || str_contains($t, 'kit de instalacion completo para lavaplatos')
            || str_contains($t, 'mueble alto') && str_contains($t, 'cocina')
            || str_contains($t, 'mueble bajo') && str_contains($t, 'cocina')
            || str_contains($t, 'barra auxiliar') && str_contains($t, 'cocina')
            || str_contains($t, 'meson de cocina')
            || str_contains($t, 'meson barra') && str_contains($t, 'quarztone')
            || str_contains($t, 'riel spot') && str_contains($t, 'cocina')
            || str_contains($t, 'campana extractora')
            || str_contains($t, 'estufa de empotrar')
            || str_contains($t, 'horno de empotrar')
            || str_contains($t, 'punto de gas')
            || str_contains($t, 'mueble de ropas');

        $isBano = str_contains($t, 'division de baño') || str_contains($t, 'division de bano')
            || str_contains($t, 'espejo flotado')
            || str_contains($t, 'mueble flotado de baño') || str_contains($t, 'mueble flotado de bano')
            || str_contains($t, 'sanitario') || str_contains($t, 'lavamanos')
            || str_contains($t, 'acoflex') || str_contains($t, 'acoflex') || str_contains($t, 'aquaflex')
            || str_contains($t, 'combo ecoclean') || str_contains($t, 'kit sanitario') || str_contains($t, 'brida') || str_contains($t, 'taza')
            || str_contains($t, 'ducha monocontrol') || str_contains($t, 'griferia ducha')
            || str_contains($t, 'meson lavamanos') || str_contains($t, 'tipo guitarra')
            || (!$isCocina && (str_contains($t, 'griferia ducha') || str_contains($t, 'ducha')));

        $isHabitacion = str_contains($t, 'closet habitaciones') || str_contains($t, 'closet')
            || (str_contains($t, 'puerta') && str_contains($t, 'alcoba'));

        if ($isPuerta) {
            $cats[] = 'bano';
            $cats[] = 'habitaciones';
        }
        if ($isBano) {
            if (!in_array('bano', $cats)) $cats[] = 'bano';
        }
        if ($isHabitacion) {
            if (!in_array('habitaciones', $cats)) $cats[] = 'habitaciones';
        }
        if ($isCocina) {
            if (!in_array('cocina', $cats)) $cats[] = 'cocina';
        }

        if (empty($cats)) {
            $isGeneral = str_contains($t, 'piso') || str_contains($t, 'muro') || str_contains($t, 'techo') || str_contains($t, 'aseo') || str_contains($t, 'drywall') || str_contains($t, 'estuco') || str_contains($t, 'pintura');
            if ($isGeneral) return ['bano','cocina','habitaciones'];
            return [];
        }

        return array_unique($cats);
    }
}
