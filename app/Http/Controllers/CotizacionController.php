<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cotizacion;
use App\Services\CotizacionService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CotizacionController extends Controller
{
    use AuthorizesRequests;

    /**
     * Mostrar todas las cotizaciones.
     * SOLO el administrador puede hacer esto.
     */
    public function index()
    {
        $this->authorize('viewAny', Cotizacion::class);
        $cotizaciones = Cotizacion::all();
        return response()->json($cotizaciones);
    }

    /**
     * Crear una cotización inicial y devolver los planes.
     */
    public function store(Request $request, CotizacionService $cotizador)
    {
        // 1. Validar los datos de entrada
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'required|string|max:20',
            'tipo_obra' => 'nullable|string',
            'area_privada' => 'nullable|numeric',
            'nombre_proyecto' => 'nullable|string|max:255',
            'fecha_entrega' => 'nullable|date',
        ]);

        try {
            // 2. Crear la cotización en la base de datos con los datos del usuario
            $cotizacion = Cotizacion::create($validatedData);

            // 3. Obtener los 3 planes calculados usando el servicio
            $planesDisponibles = $cotizador->calcularPlanesDisponibles(
                $request->input('tipo_obra'),
                $request->input('area_privada'),
                $request->input('fecha_entrega')
            );

            // 4. Si el servicio devolvió un error (porque mandaron "Residencial" u otro texto inválido)
            if (isset($planesDisponibles['error'])) {
                return response()->json([
                    'mensaje' => 'Cotización guardada, pero no se pudieron calcular los planes.',
                    'datos_cliente' => $cotizacion,
                    'detalle_error' => $planesDisponibles['error']
                ], 206); // 206 Partial Content
            }

            // 5. Retornar la respuesta exitosa con el cliente y sus opciones de pago
            return response()->json([
                'mensaje' => 'Cotización creada con éxito. Elige un plan.',
                'datos_cliente' => $cotizacion,
                'planes_disponibles' => $planesDisponibles
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No se pudo guardar la cotización en la base de datos',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }
}