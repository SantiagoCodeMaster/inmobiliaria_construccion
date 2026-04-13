<?php

namespace App\Http\Controllers;

use App\Models\PropuestaActividad;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PropuestaActividadController extends Controller
{
    use AuthorizesRequests;

    /**
     * Lista todas las actividades de una propuesta específica.
     * GET /propuestas/{tipo}/actividades  (tipo: elemental|estandar|experto)
     */
    public function porTipo($tipo)
    {
        $this->authorize('viewAny', PropuestaActividad::class);

        $items = PropuestaActividad::where('tipo_propuesta', $tipo)
            ->with('actividad')
            ->get();

        return response()->json($items);
    }

    /**
     * Asigna una actividad a una propuesta.
     *
     * Body JSON:
     *   tipo_propuesta (elemental|estandar|experto), actividad_id (int),
     *   area_base (numeric), multiplicador_m2 (numeric|null)
     */
    public function store(Request $request)
    {
        $this->authorize('create', PropuestaActividad::class);

        $validated = $request->validate([
            'tipo_propuesta'  => 'required|in:elemental,estandar,experto',
            'actividad_id'    => 'required|exists:actividades,id',
            'area_base'       => 'required|numeric|min:0',
            'multiplicador_m2' => 'nullable|numeric|min:0',
        ]);

        $item = PropuestaActividad::create($validated);
        $item->load('actividad');

        return response()->json($item, 201);
    }

    /**
     * Actualiza área_base o multiplicador_m2 de una asignación.
     */
    public function update(Request $request, $id)
    {
        $item = PropuestaActividad::findOrFail($id);
        $this->authorize('update', $item);

        $validated = $request->validate([
            'area_base'        => 'sometimes|numeric|min:0',
            'multiplicador_m2' => 'nullable|numeric|min:0',
        ]);

        $item->update($validated);
        $item->load('actividad');

        return response()->json($item);
    }

    /**
     * Elimina la asignación de una actividad en una propuesta.
     */
    public function destroy($id)
    {
        $item = PropuestaActividad::findOrFail($id);
        $this->authorize('delete', $item);

        $item->delete();

        return response()->json(['mensaje' => 'Actividad removida de la propuesta.']);
    }
}
