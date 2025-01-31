<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controllers as Ctrl;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;

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


Route::middleware(['auth'])->group(function () {
    Route::get('/user/profile', [UserProfileController::class, 'show'])->name('profile.show');
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

    Route::resource('/clientes', Ctrl::$clienteController)->names('clientes');
    Route::resource('/cliente-referencias', Ctrl::$clienteReferenciaController)->names('cliente-referencias');

    Route::resource('/bitacoras', Ctrl::$bitacoraController)->names('bitacoras');
    Route::resource('/conceptos-egreso', Ctrl::$conceptoEgresoController)->names('conceptos-egreso');

    // ruta para contraros test
    // Route::get('/contratos/test', [Ctrl::$contratoController, 'test'])->name('contratos.test');

    //ruta cancelar contrato
    Route::get('/contratos/{contrato}', [Ctrl::$contratoController, 'show'])->name('contratos.show');
    Route::get('/contrato/{id}/cancelar', [Ctrl::$contratoController, 'cancelarContrato'])->name('contrato.cancelar');
    Route::get('/contrato/{id}/promesa-pdf', [Ctrl::$contratoController, 'generarPromesaVentaPDF'])->name('contratoPromesaPdf');
    Route::resource('/contratos', Ctrl::$contratoController)->names('contratos');


    Route::resource('/cortes-caja', Ctrl::$corteCajaController)->names('cortes-caja');
    Route::resource('/corte-caja-detalles', Ctrl::$corteCajaDetalleController)->names('corte-caja-detalles');
    Route::resource('/egresos', Ctrl::$egresoController)->names('egresos');
    Route::resource('/frases-eticas', Ctrl::$fraseEticaController)->names('frases-eticas');
    Route::get('/frases-eticas/random', [Ctrl::$fraseEticaController, 'random'])->name('frases-eticas.random');


    // Ruta para obtener lotes según predio vía AJAX
    Route::get('/lotes-by-predio', [Ctrl::$loteController, 'getLotesByPredio'])->name('lotes.byPredio');
    // ruta para obtener lote por idlote via ajax
    Route::get('/lotes/{id}/get', [Ctrl::$loteController, 'getLoteById'])->name('lotes.get');
    Route::resource('/lotes', Ctrl::$loteController)->names('lotes');


    // Route::post('/lotes/{idLote}/fotos', [Ctrl::$loteController, 'addFoto'])->name('lotes.addFoto');
    // Route::get('/lotes/{idLote}/fotos', [Ctrl::$loteController, 'getFotos'])->name('lotes.getFotos');
    // Route::delete('/lotes/{idLote}/fotos/{idFoto}', [Ctrl::$loteController, 'deleteFoto'])->name('lotes.deleteFoto');
    Route::resource('/morosos', Ctrl::$morosoController)->names('morosos');
    Route::resource('/morosos-seguimiento', Ctrl::$morosoSeguimientoController)->names('morosos-seguimiento');
    Route::resource('/negocios', Ctrl::$negocioController)->names('negocios');


    Route::prefix('pagos-lote')->name('pagos-lote.')->group(function () {
        Route::get('/filter', [Ctrl::$pagoLoteController, 'filter'])->name('filter');
        Route::get('/create/{contrato}', [Ctrl::$pagoLoteController, 'createByContrato'])->name('createByContrato');
        Route::post('/cancelar/{id}', [Ctrl::$pagoLoteController, 'cancelarPago'])->name('cancelarPago');
        // ruta para impresion de recibo de pago
        Route::get('/{id}/recibo-pdf', [Ctrl::$pagoLoteController, 'generarReciboPagoPDF'])->name('reciboPdf');
        Route::resource('/', Ctrl::$pagoLoteController)->parameters(['' => 'pago_lote']);
    });
    // Route::get('/pagos-lote/filter', [Ctrl::$pagoLoteController, 'filter'])->name('pagos-lote.filter');
    // Route::get('/pagos-lote/create/{contrato}', [Ctrl::$pagoLoteController, 'createByContrato'])->name('pagos-lote.createByContrato');
    // Route::resource('/pagos-lote', Ctrl::$pagoLoteController)->names('pagos-lote');



    Route::resource('/predios', Ctrl::$predioController)->names('predios');
    Route::resource('/users', Ctrl::$userController)->names('users');
});
