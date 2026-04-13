<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// ─── Autenticación ────────────────────────────────────────────────────────────
Route::post('/login', function (Request $request) {
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json(['message' => 'Credenciales incorrectas'], 401);
    }

    $user = Auth::user();

    return response()->json([
        'user'  => $user,
        'token' => $user->createToken('api-token')->plainTextToken,
    ]);
});


// ─── Rutas públicas (clientes) ────────────────────────────────────────────────

// Crear cotización y obtener las 3 propuestas calculadas
Route::post('/cotizacion/store',
    [\App\Http\Controllers\CotizacionController::class, 'store']
)->name('cotizacion.store');

// El cliente selecciona una propuesta → WhatsApp al admin
Route::post('/cotizacion/{id}/seleccionar',
    [\App\Http\Controllers\CotizacionController::class, 'seleccionarPlan']
)->name('cotizacion.seleccionarPlan');


// ─── Rutas protegidas (solo admin) ───────────────────────────────────────────
Route::middleware('auth:sanctum')->group(function () {

    // Listado de cotizaciones
    Route::get('/cotizacion/index',
        [\App\Http\Controllers\CotizacionController::class, 'index']
    )->name('cotizacion.index');

    // CRUD de actividades (catálogo maestro)
    Route::apiResource('actividades', \App\Http\Controllers\ActividadController::class);

    // CRUD de asignaciones actividad ↔ propuesta
    Route::get('/propuestas/{tipo}/actividades',
        [\App\Http\Controllers\PropuestaActividadController::class, 'porTipo']
    )->name('propuesta-actividades.porTipo');

    Route::post('/propuesta-actividades',
        [\App\Http\Controllers\PropuestaActividadController::class, 'store']
    )->name('propuesta-actividades.store');

    Route::put('/propuesta-actividades/{id}',
        [\App\Http\Controllers\PropuestaActividadController::class, 'update']
    )->name('propuesta-actividades.update');

    Route::delete('/propuesta-actividades/{id}',
        [\App\Http\Controllers\PropuestaActividadController::class, 'destroy']
    )->name('propuesta-actividades.destroy');
});
