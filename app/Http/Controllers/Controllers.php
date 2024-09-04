<?php

namespace App\Http\Controllers;


// Importación de todos los controladores de la carpeta
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ClienteReferenciaController;
use App\Http\Controllers\ConceptoEgresoController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\CorteCajaController;
use App\Http\Controllers\CorteCajaDetalleController;
use App\Http\Controllers\EgresoController;
use App\Http\Controllers\FraseEticaController;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\MorosoController;
use App\Http\Controllers\MorosoSeguimientoController;
use App\Http\Controllers\NegocioController;
use App\Http\Controllers\PagoLoteController;
use App\Http\Controllers\PredioController;

class Controllers
{
    public static $bitacoraController = BitacoraController::class;
    public static $clienteController = ClienteController::class;
    public static $clienteReferenciaController = ClienteReferenciaController::class;
    public static $conceptoEgresoController = ConceptoEgresoController::class;
    public static $contratoController = ContratoController::class;
    public static $corteCajaController = CorteCajaController::class;
    public static $corteCajaDetalleController = CorteCajaDetalleController::class;
    public static $egresoController = EgresoController::class;
    public static $fraseEticaController = FraseEticaController::class;
    public static $loteController = LoteController::class;
    public static $morosoController = MorosoController::class;
    public static $morosoSeguimientoController = MorosoSeguimientoController::class;
    public static $negocioController = NegocioController::class;
    public static $pagoLoteController = PagoLoteController::class;
    public static $predioController = PredioController::class;
}
