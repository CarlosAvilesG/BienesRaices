<?php

namespace App\Providers;

use App\Models\CorteCajaDetalle;
use Illuminate\Support\ServiceProvider;
use App\Repositories\ClienteRepositoryInterface;
use App\Repositories\ClienteRepository;

use App\Repositories\ClienteReferenciaRepository;
use App\Repositories\ClienteReferenciaRepositoryInterface;
// use App\Repositories\ClienteRepository;
// use App\Repositories\ClienteRepositoryInterface;
use App\Repositories\BitacoraRepository;
use App\Repositories\BitacoraRepositoryInterface;
use App\Repositories\ConceptoEgresoRepository;
use App\Repositories\ConceptoEgresoRepositoryInterface;
use App\Repositories\ContratoRepository;
use App\Repositories\ContratoRepositoryInterface;
use App\Repositories\CorteCajaRepository;
use App\Repositories\CorteCajaRepositoryInterface;
use App\Repositories\CorteCajaDetalleRepositoryInterface;
use App\Repositories\CorteCajaDetalleRepository;
use App\Repositories\EgresoRepositoryInterface;
use App\Repositories\EgresoRepository;
use App\Repositories\FraseEticaRepositoryInterface;
use App\Repositories\FraseEticaRepository;
use App\Repositories\LoteRepositoryInterface;
use App\Repositories\LoteRepository;
use App\Repositories\MorosoRepositoryInterface;
use App\Repositories\MorosoRepository;
use App\Repositories\MorosoSeguimientoRepositoryInterface;
use App\Repositories\MorosoSeguimientoRepository;
use App\Repositories\NegocioRepositoryInterface;
use App\Repositories\NegocioRepository;
use App\Repositories\PagoLoteRepositoryInterface;
use App\Repositories\PagoLoteRepository;
use App\Repositories\PredioRepositoryInterface;
use App\Repositories\PredioRepository;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\UserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(
            ClienteRepositoryInterface::class,  ClienteRepository::class,
            ClienteReferenciaRepositoryInterface::class,   ClienteReferenciaRepository::class,
            BitacoraRepositoryInterface::class,
            BitacoraRepository::class,
            ConceptoEgresoRepositoryInterface::class, ConceptoEgresoRepository::class,
            ContratoRepositoryInterface::class,
            ContratoRepository::class,
            CorteCajaRepositoryInterface::class, CorteCajaRepository::class,

            CorteCajaDetalleRepositoryInterface ::class, CorteCajaDetalleRepository::class,
            EgresoRepositoryInterface::class, EgresoRepository::class,
            FraseEticaRepositoryInterface::class, FraseEticaRepository::class,
            LoteRepositoryInterface::class, LoteRepository::class,
            MorosoRepositoryInterface::class, MorosoRepository::class,
            MorosoSeguimientoRepositoryInterface::class, MorosoSeguimientoRepository::class,
            NegocioRepositoryInterface::class, NegocioRepository::class,
            PagoLoteRepositoryInterface::class, PagoLoteRepository::class,
            PredioRepositoryInterface::class, PredioRepository::class,
            UserRepositoryInterface::class, UserRepository::class,



        );


    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
