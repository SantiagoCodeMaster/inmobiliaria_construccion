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
     * Mostrar todas las cotizaciones (solo admin).
     */
    public function index()
    {
        $this->authorize('viewAny', Cotizacion::class);
        $cotizaciones = Cotizacion::all();
        return response()->json($cotizaciones);
    }

    /**
     * Crear una cotización y devolver las tres propuestas calculadas.
     *
     * Preguntas del formulario de usuario:
     *   - nombre, apellido, email, telefono     → datos personales
     *   - area_privada                           → m² del apartamento
     *   - num_puertas                            → cantidad de puertas de madera
     *   - num_closets                            → cantidad de closets de habitación
     *   - num_banos                              → cantidad de baños
     *   - tiene_mueble_alto_cocina               → ¿tiene mueble alto en cocina? (boolean)
     *   - tiene_barra_auxiliar                   → ¿tiene barra auxiliar en cocina? (boolean)
     *   - nombre_proyecto, fecha_entrega         → datos del proyecto
     */
    public function store(Request $request, CotizacionService $cotizador)
    {
        $validated = $request->validate([
            'nombre'                   => 'required|string|max:255',
            'apellido'                 => 'required|string|max:255',
            'email'                    => 'required|email|max:255',
            'telefono'                 => 'required|string|max:20',
            'area_privada'             => 'required|numeric|min:1',
            'num_puertas'              => 'required|integer|min:0',
            'num_closets'              => 'required|integer|min:0',
            'num_banos'                => 'required|integer|min:1',
            'tiene_mueble_alto_cocina' => 'required|boolean',
            'tiene_barra_auxiliar'     => 'required|boolean',
            'nombre_proyecto'          => 'nullable|string|max:255',
            'fecha_entrega'            => 'nullable|date',
        ]);

        // tipo_obra siempre es obra gris
        $validated['tipo_obra'] = 'obra gris';

        try {
            $cotizacion = Cotizacion::create($validated);

            $propuestas = $cotizador->calcularPropuestas($validated);

            return response()->json([
                'mensaje'    => 'Cotización creada. Selecciona una propuesta.',
                'cotizacion' => $cotizacion,
                'propuestas' => $propuestas,
            ], 201);

        } catch (\Exception $e) {
            Log::error('Error creando cotización: ' . $e->getMessage());
            return response()->json([
                'error'   => 'No se pudo guardar la cotización.',
                'detalle' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * El cliente selecciona una propuesta → notificar al admin por WhatsApp.
     */
    public function seleccionarPlan(Request $request, $id)
    {
        $request->validate([
            'tipo_propuesta' => 'required|in:elemental,estandar,experto',
            'vr_total'       => 'required|numeric',
            'precio_m2'      => 'nullable|numeric',
        ]);

        try {
            $cotizacion = Cotizacion::findOrFail($id);

            $nombrePropuesta = ucfirst($request->input('tipo_propuesta'));
            $vrTotal         = number_format($request->input('vr_total'), 0, ',', '.');
            $precioM2        = $request->input('precio_m2')
                ? number_format($request->input('precio_m2'), 0, ',', '.')
                : 'N/A';

            $mensaje = "🔔 *Nueva Postulación de Proyecto*\n\n"
                . "👤 *Cliente:* {$cotizacion->nombre} {$cotizacion->apellido}\n"
                . "📞 *Teléfono:* {$cotizacion->telefono}\n"
                . "✉️ *Email:* {$cotizacion->email}\n"
                . "🏗️ *Proyecto:* " . ($cotizacion->nombre_proyecto ?? 'N/A') . "\n"
                . "📐 *Área:* {$cotizacion->area_privada} m²\n"
                . "🚪 *Puertas:* {$cotizacion->num_puertas} | "
                . "🛋️ *Closets:* {$cotizacion->num_closets} | "
                . "🚿 *Baños:* {$cotizacion->num_banos}\n"
                . "📋 *Propuesta Elegida:* {$nombrePropuesta}\n"
                . "💰 *Valor Total:* \${$vrTotal}\n"
                . "📊 *Precio/m²:* \${$precioM2}";

            $token      = env('WHATSAPP_TOKEN');
            $phoneId    = env('WHATSAPP_PHONE_ID');
            $adminPhone = env('WHATSAPP_ADMIN_PHONE');

            $response = Http::withToken($token)->post(
                "https://graph.facebook.com/v17.0/{$phoneId}/messages",
                [
                    'messaging_product' => 'whatsapp',
                    'to'                => $adminPhone,
                    'type'              => 'text',
                    'text'              => ['body' => $mensaje],
                ]
            );

            if ($response->successful()) {
                return response()->json(['mensaje' => 'Administrador notificado con éxito.']);
            }

            Log::error('Error WhatsApp API: ' . $response->body());
            return response()->json(['error' => 'No se pudo enviar el WhatsApp al administrador.'], 500);

        } catch (\Exception $e) {
            Log::error('Excepción seleccionando propuesta: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno procesando la selección.'], 500);
        }
    }
}
