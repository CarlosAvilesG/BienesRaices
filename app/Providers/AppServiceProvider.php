<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ClienteReferenciaRepository;
use App\Repositories\ClienteReferenciaRepositoryInterface;
use App\Repositories\ClienteRepository;
use App\Repositories\ClienteRepositoryInterface;
use App\Repositories\BitacoraRepository;
use App\Repositories\BitacoraRepositoryInterface;
use App\Repositories\ConceptoEgresoRepository;
use App\Repositories\ConceptoEgresoRepositoryInterface;
use App\Repositories\ContratoRepository;
use App\Repositories\ContratoRepositoryInterface;
use App\Repositories\CorteCajaRepository;
use App\Repositories\CorteCajaRepositoryInterface;
use App\Repository\CorteCajaDetalleRepositoryInterface;
use App\Repository\CorteCajaDetalleRepository;
use App\Repository\EgresoRepositoryInterface;
use App\Repository\EgresoRepository;
use App\Repository\FraseEticaRepositoryInterface;
use App\Repository\FraseEticaRepository;
use App\Repository\LoteRepositoryInterface;
use App\Repository\LoteRepository;
use App\Repository\MorosoRepositoryInterface;
use App\Repository\MorosoRepository;
use App\Repository\MorosoSeguimientoRepositoryInterface;
use App\Repository\MorosoSeguimientoRepository;
use App\Repository\NegocioRepositoryInterface;
use App\Repository\NegocioRepository;
use App\Repository\PagoLoteRepositoryInterface;
use App\Repository\PagoLoteRepository;
use App\Repository\PredioRepositoryInterface;
use App\Repository\PredioRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(
            ClienteRepositoryInterface::class,
            ClienteRepository::class,
            ClienteReferenciaRepositoryInterface::class,   ClienteReferenciaRepository::class,
            BitacoraRepositoryInterface::class,
            BitacoraRepository::class,
            ConceptoEgresoRepositoryInterface::class, ConceptoEgresoRepository::class,
            ContratoRepositoryInterface::class,
            ContratoRepository::class,
            CorteCajaRepositoryInterface::class, CorteCajaRepository::class,
            CorteCajaDetalleRepositoryInterface::class, CorteCajaDetalleRepository::class,
            EgresoRepositoryInterface::class, EgresoRepository::class,
            FraseEticaRepositoryInterface::class, FraseEticaRepository::class,
            LoteRepositoryInterface::class, LoteRepository::class,
            MorosoRepositoryInterface::class, MorosoRepository::class,
            MorosoSeguimientoRepositoryInterface::class, MorosoSeguimientoRepository::class,
            NegocioRepositoryInterface::class, NegocioRepository::class,
            PagoLoteRepositoryInterface::class, PagoLoteRepository::class,
            PredioRepositoryInterface::class, PredioRepository::class,

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
