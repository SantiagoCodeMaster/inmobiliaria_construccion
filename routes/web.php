<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
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
});


require __DIR__.'/auth.php';
