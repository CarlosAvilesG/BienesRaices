<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ClienteRepositoryInterface;
use App\Repositories\ClienteRepository;
use App\Repositories\ClienteReferenciaRepository;
use App\Repositories\ClienteReferenciaRepositoryInterface;
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
        // Registrar bindings individuales para cada repositorio
        $this->app->bind(ClienteRepositoryInterface::class, ClienteRepository::class);
        $this->app->bind(ClienteReferenciaRepositoryInterface::class, ClienteReferenciaRepository::class);
        $this->app->bind(BitacoraRepositoryInterface::class, BitacoraRepository::class);
        $this->app->bind(ConceptoEgresoRepositoryInterface::class, ConceptoEgresoRepository::class);
        $this->app->bind(ContratoRepositoryInterface::class, ContratoRepository::class);
        $this->app->bind(CorteCajaRepositoryInterface::class, CorteCajaRepository::class);
        $this->app->bind(CorteCajaDetalleRepositoryInterface::class, CorteCajaDetalleRepository::class);
        $this->app->bind(EgresoRepositoryInterface::class, EgresoRepository::class);
        $this->app->bind(FraseEticaRepositoryInterface::class, FraseEticaRepository::class);
        $this->app->bind(LoteRepositoryInterface::class, LoteRepository::class);
        $this->app->bind(MorosoRepositoryInterface::class, MorosoRepository::class);
        $this->app->bind(MorosoSeguimientoRepositoryInterface::class, MorosoSeguimientoRepository::class);
        $this->app->bind(NegocioRepositoryInterface::class, NegocioRepository::class);
        $this->app->bind(PagoLoteRepositoryInterface::class, PagoLoteRepository::class);
        $this->app->bind(PredioRepositoryInterface::class, PredioRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
