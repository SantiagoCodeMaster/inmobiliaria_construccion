<?php

namespace App\Http\Controllers;

use App\Models\Cotizacion;
use Illuminate\Http\Request;

class AdminCotizacionController extends Controller
{
    private function checkAdmin(): void
    {
        abort_unless(auth()->check() && auth()->user()->is_admin == 1, 403);
    }

    public function update(Request $request, $id)
    {
        $this->checkAdmin();

        $validated = $request->validate([
            'nombre'                   => 'required|string|max:255',
            'apellido'                 => 'required|string|max:255',
            'email'                    => 'required|email|max:255',
            'telefono'                 => 'required|string|max:20',
            'tipo_obra'                => 'nullable|string|max:255',
            'nombre_proyecto'          => 'nullable|string|max:255',
            'area_privada'             => 'nullable|numeric|min:0',
            'fecha_entrega'            => 'nullable|date',
            'num_banos'                => 'nullable|integer|min:0',
            'tiene_mueble_alto_cocina' => 'nullable|boolean',
            'tiene_barra_auxiliar'     => 'nullable|boolean',
        ]);

        Cotizacion::findOrFail($id)->update($validated);

        return redirect()->route('dashboard')->with('success', 'Cotización actualizada correctamente.');
    }

    public function destroy($id)
    {
        $this->checkAdmin();

        Cotizacion::findOrFail($id)->delete();

        return redirect()->route('dashboard')->with('success', 'Cotización eliminada permanentemente.');
    }
}
