<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ActividadController extends Controller
{
    use AuthorizesRequests;

    /**
     * Lista todas las actividades con sus asignaciones de propuesta.
     */
    public function index()
    {
        $this->authorize('viewAny', Actividad::class);

        $actividades = Actividad::with('propuestaActividades')->get();

        return response()->json($actividades);
    }

    /**
     * Crea una nueva actividad en el catálogo.
     *
     * Body JSON:
     *   nombre (string), descripcion (string), unidad (m2|UND),
     *   valor_unitario (numeric), campo_usuario (nullable string), link (nullable string)
     */
    public function store(Request $request)
    {
        $this->authorize('create', Actividad::class);

        $validated = $request->validate([
            'nombre'         => 'required|string|max:255',
            'descripcion'    => 'required|string',
            'unidad'         => 'required|in:m2,UND',
            'valor_unitario' => 'required|numeric|min:0',
            'campo_usuario'  => 'nullable|string|max:100',
            'link'           => 'nullable|string|max:500',
        ]);

        $actividad = Actividad::create($validated);

        return response()->json($actividad, 201);
    }

    /**
     * Muestra una actividad con sus asignaciones de propuesta.
     */
    public function show($id)
    {
        $actividad = Actividad::with('propuestaActividades')->findOrFail($id);
        $this->authorize('view', $actividad);

        return response()->json($actividad);
    }

    /**
     * Actualiza una actividad existente.
     */
    public function update(Request $request, $id)
    {
        $actividad = Actividad::findOrFail($id);
        $this->authorize('update', $actividad);

        $validated = $request->validate([
            'nombre'         => 'sometimes|string|max:255',
            'descripcion'    => 'sometimes|string',
            'unidad'         => 'sometimes|in:m2,UND',
            'valor_unitario' => 'sometimes|numeric|min:0',
            'campo_usuario'  => 'nullable|string|max:100',
            'link'           => 'nullable|string|max:500',
        ]);

        $actividad->update($validated);

        return response()->json($actividad);
    }

    /**
     * Elimina una actividad (también elimina sus asignaciones de propuesta por cascada).
     */
    public function destroy($id)
    {
        $actividad = Actividad::findOrFail($id);
        $this->authorize('delete', $actividad);

        $actividad->delete();

        return response()->json(['mensaje' => 'Actividad eliminada.']);
    }
}
