<?php

use App\Http\Controllers\AdminCotizacionDetalleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/remodelacion-vivienda-usada', [\App\Http\Controllers\RemodelacionViviendaUsadaController::class, 'index'])->name('remodelacion.vivienda.usada');
});

Route::get('/experiencia', function () {
    return view('prueba');
})->name('nuestra.experiencia');

// Ruta para ver el QR
Route::get('/ver-qr', function () {
    return view('qr-view');
});

Route::get('/back-up', function () {
    return view('backup');
})->name('backup');

Route::get('/dashboard', function () {
    $cotizaciones = \App\Models\Cotizacion::latest()->get();

    return view('dashboard', compact('cotizaciones'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::put('/admin/cotizaciones/{id}', [\App\Http\Controllers\AdminCotizacionController::class, 'update'])->name('admin.cotizaciones.update');
    Route::delete('/admin/cotizaciones/{id}', [\App\Http\Controllers\AdminCotizacionController::class, 'destroy'])->name('admin.cotizaciones.destroy');

    // Descarga PDF de cotización (protegido, solo usuarios autenticados)
    Route::get('/cotizacion/{id}/pdf/{tipo}',
        [\App\Http\Controllers\CotizacionController::class, 'descargarPdf']
    )->name('cotizacion.pdf');

    // Editor de actividades por cotización
    Route::get('/admin/cotizaciones/{cotizacion}/detalle', [AdminCotizacionDetalleController::class, 'edit'])->name('admin.cotizaciones.detalle');
    Route::get('/admin/cotizaciones/{cotizacion}/detalle/data/{tipo}', [AdminCotizacionDetalleController::class, 'data']);
    Route::post('/admin/cotizaciones/{cotizacion}/detalle/save/{tipo}', [AdminCotizacionDetalleController::class, 'save']);
    Route::post('/admin/cotizaciones/{cotizacion}/detalle/recalcular', [AdminCotizacionDetalleController::class, 'recalcular']);
    Route::get('/admin/cotizaciones/catalogo', [AdminCotizacionDetalleController::class, 'catalogo']);
});

require __DIR__.'/auth.php';
