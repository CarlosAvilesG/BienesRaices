<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Controllers as Ctrl;


Route::get('/', function () {
    return view('welcome');
});




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rutas para ClienteController usando el archivo de barril
    Route::get('/clientes', [Ctrl::$clienteController, 'index'])->name('clientes.index');
    Route::get('/clientes/create', [Ctrl::$clienteController, 'create'])->name('clientes.create');
    Route::post('/clientes', [Ctrl::$clienteController, 'store'])->name('clientes.store');
    Route::get('/clientes/{cliente}', [Ctrl::$clienteController, 'show'])->name('clientes.show');
    Route::get('/clientes/{cliente}/edit', [Ctrl::$clienteController, 'edit'])->name('clientes.edit');
    Route::put('/clientes/{cliente}', [Ctrl::$clienteController, 'update'])->name('clientes.update');
    Route::delete('/clientes/{cliente}', [Ctrl::$clienteController, 'destroy'])->name('clientes.destroy');

});

// Route::resource('corte-caja-detalles', CorteCajaDetalleController::class);
//Route::resource('egresos', EgresoController::class);
/*
Route::get('frases/random', [FraseEticaController::class, 'random']);
Route::resource('frases', FraseEticaController::class);
 */

 /*

Route::get('lotes/{id}/fotos', [LoteController::class, 'getFotos']);
Route::post('lotes/{id}/fotos', [LoteController::class, 'addFoto']);
Route::delete('lotes/{id}/fotos/{fotoId}', [LoteController::class, 'deleteFoto']);
Route::resource('lotes', LoteController::class);

-*/
/*
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('morosos', MorosoController::class);
});
 */

 /* Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('moroso-seguimientos', MorosoSeguimientoController::class);
});*/

/*Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('negocios', NegocioController::class);
});
*/

/*Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('pagos-lote', PagoLoteController::class);
});
*/

/*Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::resource('predios', PredioController::class);
});*/
