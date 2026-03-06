<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::post('/login', function (Request $request) {

    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json([
            'message' => 'Credenciales incorrectas'
        ], 401);
    }

    $user = Auth::user();

    return response()->json([
        'user' => $user,
        'token' => $user->createToken('api-token')->plainTextToken
    ]);
});


// 🔓 RUTA PÚBLICA (cualquiera puede crear cotización)
Route::post('/cotizacion/store', 
    [\App\Http\Controllers\CotizacionController::class, 'store']
)->name('cotizacion.store');


// 🔐 RUTAS PROTEGIDAS
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/cotizacion/index', 
        [\App\Http\Controllers\CotizacionController::class, 'index']
    )->name('cotizacion.index');

    Route::apiResource('productos/crear', \App\Http\Controllers\ProductoController::class);


});