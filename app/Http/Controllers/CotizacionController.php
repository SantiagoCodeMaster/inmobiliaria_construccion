<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cotizacion;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
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

            // 3. Obtener los planes calculados usando el servicio
            // Fórmula: Precio Total = m² × valor_unitario de cada plan
            $planesDisponibles = $cotizador->calcularPlanesDisponibles(
                $request->input('tipo_obra'),
                $request->input('area_privada')
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

    public function seleccionarPlan(Request $request, $id)
    {
        // 1. Validar lo que envía el frontend
        $request->validate([
            'nombre_plan' => 'required|string',
            'precio' => 'required|numeric'
        ]);

        try {
            // 2. Buscar la cotización en la BD (creada previamente en el método store)
            $cotizacion = Cotizacion::findOrFail($id);
            
            // Opcional: Actualizar la cotización con el plan que eligió el cliente
            // $cotizacion->plan_elegido = $request->input('nombre_plan');
            // $cotizacion->save();

            // 3. Construir el mensaje para el administrador
            $mensaje = "🔔 *Nueva Postulación de Proyecto*\n\n"
                     . "👤 *Cliente:* {$cotizacion->nombre} {$cotizacion->apellido}\n"
                     . "📞 *Teléfono:* {$cotizacion->telefono}\n"
                     . "✉️ *Email:* {$cotizacion->email}\n"
                     . "🏗️ *Proyecto:* " . ($cotizacion->nombre_proyecto ?? 'N/A') . "\n"
                     . "📋 *Plan Elegido:* {$request->input('nombre_plan')}\n"
                     . "💰 *Valor Aprox:* $" . number_format($request->input('precio'), 0, ',', '.');

            // 4. Enviar el mensaje usando la API de Meta
            $token = env('WHATSAPP_TOKEN');
            $phoneId = env('WHATSAPP_PHONE_ID');
            $adminPhone = env('WHATSAPP_ADMIN_PHONE');

            $response = Http::withToken($token)->post("https://graph.facebook.com/v17.0/{$phoneId}/messages", [
                'messaging_product' => 'whatsapp',
                'to' => $adminPhone,
                'type' => 'text',
                'text' => [
                    'body' => $mensaje
                ]
            ]);

            if ($response->successful()) {
                return response()->json(['mensaje' => 'Administrador notificado con éxito.']);
            } else {
                Log::error('Error de WhatsApp API: ' . $response->body());
                return response()->json(['error' => 'No se pudo enviar el WhatsApp al administrador.'], 500);
            }

        } catch (\Exception $e) {
            Log::error('Excepción seleccionando plan: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno procesando la selección.'], 500);
        }
    }
}