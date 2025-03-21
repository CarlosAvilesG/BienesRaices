<?php

namespace App\Http\Controllers;


use App\Repositories\CorteCajaRepositoryInterface;
use App\Repositories\CorteCajaDetalleRepositoryInterface;
use App\Repositories\EgresoRepositoryInterface;

use App\Repositories\PagoLoteRepositoryInterface;
use App\Repositories\PredioRepositoryInterface;
use App\Repositories\ContratoRepositoryInterface;
use App\Repositories\LoteRepositoryInterface;
use App\Repositories\ClienteRepositoryInterface;
use App\Repositories\NegocioRepositoryInterface;

use App\Http\Requests\StoreCorteCajaRequest;
use App\Http\Requests\UpdateCorteCajaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CorteCajaController extends Controller
{
    protected $corteCaja;
    protected $corteCajaDetalle;
    protected $pagoLotes;
    protected $egresos;

    public function __construct(CorteCajaRepositoryInterface $corteCajaRepository , PagoLoteRepositoryInterface $pagoLotesRepository , EgresoRepositoryInterface $egresosRepository, CorteCajaDetalleRepositoryInterface $corteCajaDetalleRepository)
    {
        $this->corteCaja = $corteCajaRepository;
        $this->pagoLotes = $pagoLotesRepository;
        $this->egresos = $egresosRepository;
        $this->corteCajaDetalle = $corteCajaDetalleRepository;
    }

    // Mostrar una lista de todos los cortes de caja
    public function index()
    {
        $usuario = Auth::user(); // 🔹 Obtener el usuario autenticado

        // 🔹 Último corte registrado por este usuario
        $ultimoCorte = $this->corteCaja->getCorteByUser($usuario->id);

        // 🔹 Definir el rango de fechas del corte
        $fechaInicio = $ultimoCorte ? Carbon::parse($ultimoCorte->fechaFin)->addSecond() : Carbon::now()->startOfWeek();
        $fechaFin = Carbon::now()->endOfWeek();

        // 🔹 Filtrar pagos solo del usuario autenticado
        $ingresos = $this->pagoLotes->getPagosByUser($usuario->id, $fechaInicio, $fechaFin);


        // 🔹 Calcular totales de ingresos
        $totalIngresosFisicos = $ingresos->where('tipoPago', 'Efectivo')->sum('monto');
        $totalIngresosTransferencia = $ingresos->where('tipoPago', 'Transferencia')->sum('monto');
        $totalIngresosCheques = $ingresos->where('tipoPago', 'Cheque')->sum('monto');

        // 🔹 Filtrar egresos solo del usuario autenticado
        $egresos =  $this->egresos->getEgresosByUser($usuario->id, $fechaInicio, $fechaFin);

        // 🔹 Calcular total de egreso
        $totalEgresos = $egresos->sum('monto');



        return view('sistema.corte_caja.index', compact(
            'fechaInicio',
            'fechaFin',
            'ingresos',
            'egresos',
            'totalIngresosFisicos',
            'totalIngresosTransferencia',
            'totalIngresosCheques',
            'totalEgresos',
            'usuario'
        ));
    }

    // Almacenar un nuevo corte de caja en la base de datos
    public function store(StoreCorteCajaRequest $request)
    {
        dd('entro a store');
        try {

            dd('entro a store');
            DB::beginTransaction(); // Iniciar transacción

            $usuario = Auth::user(); // 🔹 Obtener el usuario autenticado

            // 📅 Obtener la fecha del último corte o del primer pago registrado
            $ultimoCorte = $this->corteCaja->getCorteByUser($usuario->id);
            $primerPago = $this->pagoLotes->getFirstPagoByUser($usuario->id);

            $fechaInicio = $ultimoCorte ? Carbon::parse($ultimoCorte->fechaFin)->addSecond()
                                        : ($primerPago ? Carbon::parse($primerPago->fechaPago)->startOfDay() : Carbon::now()->startOfWeek());

            $fechaFin = now(); // La fecha de cierre será el momento actual

            // 🔹 Obtener ingresos usando el repositorio
            $ingresos = $this->pagoLotes->getPagosByUser($usuario->id, $fechaInicio, $fechaFin);
            $ingresosFisicos = $ingresos->where('tipoPago', 'Efectivo')->sum('monto');
            $ingresosBancarios = $ingresos->whereIn('tipoPago', ['Transferencia', 'Cheque'])->sum('monto');

            // 🔹 Obtener egresos usando el repositorio
            $egresos = $this->egresos->getEgresosByUser($usuario->id, $fechaInicio, $fechaFin);
            $totalEgresos = $egresos->sum('monto');

dd ($ingresos, $egresos,  $ultimoCorte, $fechaInicio);

            // 💾 Guardar el corte de caja con el repositorio
            $corteCaja = $this->corteCaja->create([
                'fechaInicio' => $fechaInicio,
                'fechaFin' => $fechaFin,
                'totalIngresosFisicos' => $ingresosFisicos,
                'totalIngresosBancarios' => $ingresosBancarios,
                'totalEgresos' => $totalEgresos,
                'totalPrestamos' => 0, // Puedes modificar si es necesario
                'idUsuario' => $usuario->id,
            ]);


            // 📌 Guardar detalles del corte en `corte_caja_detalles`
            foreach ($ingresos as $ingreso) {
                $this->corteCajaDetalle->create([
                    'idCorteCaja' => $corteCaja->id,
                    'idPagoLote' => $ingreso->id,
                    'idEgreso' => null,
                    'monto' => $ingreso->monto,
                    'tipoMovimiento' => 'Ingreso',
                ]);
            }

            foreach ($egresos as $egreso) {
                $this->corteCajaDetalle->create([
                    'idCorteCaja' => $corteCaja->id,
                    'idPagoLote' => null,
                    'idEgreso' => $egreso->id,
                    'monto' => $egreso->monto,
                    'tipoMovimiento' => 'Egreso',
                ]);
            }

            DB::commit(); // Confirmar transacción

            return redirect()->route('corte-caja.index')->with('success', 'Corte de caja registrado correctamente.');

        } catch (\Exception $e) {
            DB::rollBack(); // Revertir cambios si hay error
            return redirect()->back()->with('error', 'Error al registrar el corte de caja: ' . $e->getMessage());
        }
    }

    // Mostrar un corte de caja específico
    public function show($id)
    {
        // $corte = $this->corteCajaRepository->findById($id);
        // return response()->json($corte);
    }

    // Actualizar un corte de caja existente
    public function update(UpdateCorteCajaRequest $request, $id)
    {
        // $corte = $this->corteCajaRepository->update($id, $request->validated());
        // return response()->json($corte);
    }

    // Eliminar un corte de caja
    public function destroy($id)
    {
        // $this->corteCajaRepository->delete($id);
        // return response()->json(null, 204);
    }

// METODOS
    public function cerrarCorte(StoreCorteCajaRequest $request)
    {
        dd('Entro a cerrar_corte');
        try {
            // Puedes agregar validaciones extra aquí si es necesario

            // ✅ Llamar internamente a store()
            return $this->store($request);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al cerrar el corte: ' . $e->getMessage());
        }
    }
}
