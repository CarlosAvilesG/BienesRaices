<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
//use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Controllers as Ctrl;


// Route::get('/', function () {
//     return view('welcome');
// });

// Página de bienvenida pública
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard'); // Si el usuario está autenticado, redirígelo al panel de control (cambia la ruta según lo necesites)
    }

    return view('guest.welcome'); // Si no está autenticado, muestra la vista de bienvenida
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

Route::middleware('auth')->get('/terms', function () {
    return view('terms');
})->name('terms');



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

    Route::resource('/clientes', Ctrl::$clienteController)->names('cliente');
});

/*

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    // Rutas para Clientes
    Route::resource('clientes', Ctrl::$clienteController);

    // Rutas para Cliente Referencia
    Route::resource('cliente-referencias', Ctrl::$clienteReferenciaController);

    // Rutas para Bitácora
    Route::resource('bitacoras', Ctrl::$bitacoraController);

    // Rutas para Conceptos de Egreso
    Route::resource('conceptos-egreso', Ctrl::$conceptoEgresoController);

    // Rutas para Contratos
    Route::resource('contratos', Ctrl::$contratoController);

    // Rutas para Cortes de Caja
    Route::resource('cortes-caja', Ctrl::$corteCajaController);

    // Rutas para Detalles de Corte de Caja
    Route::resource('corte-caja-detalles', Ctrl::$corteCajaDetalleController);

    // Rutas para Egresos
    Route::resource('egresos', Ctrl::$egresoController);

    // Rutas para Frases Éticas
    Route::resource('frases-eticas', Ctrl::$fraseEticaController);
    Route::get('frases-eticas/random', [Ctrl::$fraseEticaController, 'random'])->name('frases-eticas.random');

    // Rutas para Lotes
    Route::resource('lotes', Ctrl::$loteController);
    Route::post('lotes/{idLote}/fotos', [Ctrl::$loteController, 'addFoto'])->name('lotes.addFoto');
    Route::get('lotes/{idLote}/fotos', [Ctrl::$loteController, 'getFotos'])->name('lotes.getFotos');
    Route::delete('lotes/{idLote}/fotos/{idFoto}', [Ctrl::$loteController, 'deleteFoto'])->name('lotes.deleteFoto');

    // Rutas para Morosos
    Route::resource('morosos', Ctrl::$morosoController);

    // Rutas para Seguimiento de Morosos
    Route::resource('morosos-seguimiento', Ctrl::$morosoSeguimientoController);

    // Rutas para Negocios
    Route::resource('negocios', Ctrl::$negocioController);

    // Rutas para Pagos de Lote
    Route::resource('pagos-lote', Ctrl::$pagoLoteController);

    // Rutas para Predios
    Route::resource('predios', Ctrl::$predioController);

    // Rutas para Usuarios
    Route::resource('users', Ctrl::$userController);
});

*/





// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {

//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');

//     // Rutas para ClienteController usando el archivo de barril
//     Route::get('/clientes', [Ctrl::$clienteController, 'index'])->name('clientes.index');
//     Route::get('/clientes/create', [Ctrl::$clienteController, 'create'])->name('clientes.create');
//     Route::post('/clientes', [Ctrl::$clienteController, 'store'])->name('clientes.store');
//     Route::get('/clientes/{cliente}', [Ctrl::$clienteController, 'show'])->name('clientes.show');
//     Route::get('/clientes/{cliente}/edit', [Ctrl::$clienteController, 'edit'])->name('clientes.edit');
//     Route::put('/clientes/{cliente}', [Ctrl::$clienteController, 'update'])->name('clientes.update');
//     Route::delete('/clientes/{cliente}', [Ctrl::$clienteController, 'destroy'])->name('clientes.destroy');

// });

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
/*
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::resource('users', UserController::class);
});
 */
