<?php

namespace App\Http\Controllers;

use App\Models\Cotizacion;
use App\Models\CotizacionActividad;
use App\Models\Actividad;
use App\Services\CotizacionService;
use Illuminate\Http\Request;

class AdminCotizacionDetalleController extends Controller
{
    private function checkAdmin(): void
    {
        abort_unless(auth()->check() && auth()->user()->is_admin == 1, 403);
    }

    public function edit(Cotizacion $cotizacion)
    {
        $this->checkAdmin();
        return view('admin.cotizacion-detalle', compact('cotizacion'));
    }

    public function data(Cotizacion $cotizacion, string $tipo, CotizacionService $cotizador)
    {
        $this->checkAdmin();

        $customs = CotizacionActividad::where('cotizacion_id', $cotizacion->id)
            ->where('tipo_plan', $tipo)
            ->get();

        if ($customs->isNotEmpty()) {
            return response()->json([
                'usando_personalizadas' => true,
                'detalle' => $customs->map(fn ($a) => [
                    'id'             => $a->id,
                    'categoria'      => $a->categoria,
                    'descripcion'    => $a->descripcion,
                    'unidad'         => $a->unidad,
                    'cantidad'       => (float) $a->cantidad,
                    'valor_unitario' => (int) round((float) $a->valor_unitario),
                    'vr_total'       => (int) round((float) $a->vr_total),
                    'es_adicional'   => (bool) $a->es_adicional,
                ]),
            ]);
        }

        $datos = [
            'area_privada'             => $cotizacion->area_privada,
            'num_banos'                => $cotizacion->num_banos ?? 1,
            'num_habitaciones'         => $cotizacion->num_habitaciones ?? 1,
            'tiene_mueble_alto_cocina' => $cotizacion->tiene_mueble_alto_cocina ?? true,
            'tiene_barra_auxiliar'     => $cotizacion->tiene_barra_auxiliar ?? true,
        ];

        $propuesta = $cotizador->calcularPropuestas($datos)[$tipo] ?? [];

        return response()->json([
            'usando_personalizadas' => false,
            'detalle' => $propuesta['detalle'] ?? [],
        ]);
    }

    public function save(Request $request, Cotizacion $cotizacion, string $tipo)
    {
        $this->checkAdmin();

        $request->validate([
            'actividades'      => 'required|array',
            'actividades.*.id' => 'nullable|integer',
            'actividades.*.categoria'      => 'required|string|max:100',
            'actividades.*.descripcion'    => 'required|string',
            'actividades.*.unidad'         => 'required|string|max:10',
            'actividades.*.cantidad'       => 'required|numeric|min:0',
            'actividades.*.valor_unitario' => 'required|numeric|min:0',
            'actividades.*.es_adicional'   => 'nullable|boolean',
        ]);

        CotizacionActividad::where('cotizacion_id', $cotizacion->id)
            ->where('tipo_plan', $tipo)
            ->delete();

        foreach ($request->actividades as $act) {
            $cant  = (float) $act['cantidad'];
            $vu    = (float) $act['valor_unitario'];
            $total = $cant * $vu;

            CotizacionActividad::create([
                'cotizacion_id'  => $cotizacion->id,
                'tipo_plan'      => $tipo,
                'categoria'      => $act['categoria'],
                'descripcion'    => $act['descripcion'],
                'unidad'         => $act['unidad'],
                'cantidad'       => $cant,
                'valor_unitario' => $vu,
                'vr_total'       => $total,
                'es_adicional'   => $act['es_adicional'] ?? false,
            ]);
        }

        return response()->json(['mensaje' => 'Actividades guardadas correctamente.']);
    }

    public function catalogo()
    {
        $this->checkAdmin();
        $actividades = Actividad::orderBy('nombre')->get(['id', 'nombre', 'descripcion', 'unidad', 'valor_unitario']);
        return response()->json($actividades);
    }

    public function recalcular(Request $request, Cotizacion $cotizacion)
    {
        $this->checkAdmin();

        $request->validate([
            'actividades' => 'required|array',
        ]);

        $subtotal = 0;
        $detalle = [];
        foreach ($request->actividades as $act) {
            $cant  = (float) ($act['cantidad'] ?? 0);
            $vu    = (float) ($act['valor_unitario'] ?? 0);
            $total = $cant * $vu;
            $subtotal += $total;
            $detalle[] = [
                'categoria'      => $act['categoria'] ?? '',
                'descripcion'    => $act['descripcion'] ?? '',
                'unidad'         => $act['unidad'] ?? 'UND',
                'cantidad'       => round($cant, 2),
                'valor_unitario' => (int) round($vu),
                'vr_total'       => (int) round($total),
            ];
        }

        $cotizador = app(CotizacionService::class);
        $totales = $cotizador->calcularTotalesAIU($subtotal, (float) ($cotizacion->area_privada ?: 1));

        return response()->json([
            'subtotal'              => $totales['subtotal'],
            'administracion_12pct'  => $totales['administracion'],
            'imprevistos_3pct'      => $totales['imprevistos'],
            'utilidad_4pct'         => $totales['utilidad'],
            'iva_sobre_u_19pct'     => $totales['iva_utilidad'],
            'vr_total'              => $totales['total'],
            'precio_oferta_m2'      => $totales['precio_m2'],
            'vr_total_formateado'   => $totales['total_formateado'],
            'precio_m2_formateado'  => $totales['precio_m2_formateado'],
        ]);
    }
}
