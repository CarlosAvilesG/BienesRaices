<?php

namespace App\Http\Controllers;

use App\Repositories\PagoLoteRepositoryInterface;
use App\Repositories\PredioRepositoryInterface;
use App\Repositories\ContratoRepositoryInterface;
use App\Repositories\LoteRepositoryInterface;
use App\Repositories\ClienteRepositoryInterface;

use App\Http\Requests\StorePagoLoteRequest;
use App\Http\Requests\UpdatePagoLoteRequest;
use App\Models\Predio;
use App\Models\Lote;
use App\Models\Contrato;
use App\Models\PagoLote;
use Illuminate\Http\Request;
use Termwind\Components\Dd;

class PagoLoteController extends Controller
{
    protected $pagoLoteRepo;
    protected $predioRepo;
    protected $contratoRepo;
    protected $loteRepo;
    protected $clienteRepo;

    public function __construct(PagoLoteRepositoryInterface $pagoLoteRepo, PredioRepositoryInterface $predioRepo, ContratoRepositoryInterface $contratoRepo, LoteRepositoryInterface $loteRepo, ClienteRepositoryInterface $clienteRepo)
    {
        $this->pagoLoteRepo = $pagoLoteRepo;
        $this->predioRepo = $predioRepo;
        $this->contratoRepo = $contratoRepo;
        $this->loteRepo = $loteRepo;
        $this->clienteRepo = $clienteRepo;
    }

    // Mostrar una lista de todos los pagos de lotes
    public function index(Request $request)
    {
      
            // Construir la consulta inicial
            $query = PagoLote::query();

            // Filtrar por predio si se selecciona
            if ($request->filled('idPredio')) {
                $query->where('idPredio', $request->idPredio);
            }

            // Filtrar por lote si se selecciona
            if ($request->filled('idLote')) {
                $query->where('idLote', $request->idLote);
            }

            // Filtrar por contrato si se selecciona
            if ($request->filled('idContrato')) {
                $query->where('idContrato', $request->idContrato);
            }

            // Cargar los pagos con las relaciones necesarias
            $pagos = $query->with(['predio', 'lote', 'cliente', 'contrato'])->paginate(10);

             // Si existe algún pago, obtener el contrato asociado al primer pago
            $contratoActivo = $pagos->isNotEmpty() ? $pagos->items()[0]->contrato : null;

            // Obtener todos los contratos del lote del primer pago (si existen)
            $contratos = $contratoActivo
                ? Contrato::where('idLote', $contratoActivo->idLote)->orderBy('estatus', 'asc')->get()
                : collect();

            return view('sistema.pago_lotes.index', compact('pagos', 'contratoActivo', 'contratos'));
            // return view('sistema.pago_lotes.index', compact('pagos', 'predios', 'lotes', 'contratos'));
    }

    // Almacenar un nuevo pago en la base de datos
    public function store(StorePagoLoteRequest $request)
    {
        $pagoLote = $this->pagoLoteRepo->create($request->validated());
        return response()->json($pagoLote, 201);
    }

    // Mostrar un pago específico
    public function show($id)
    {
        $pagoLote = $this->pagoLoteRepo->findById($id);
        return response()->json($pagoLote);
    }

    // Actualizar un pago existente
    public function update(UpdatePagoLoteRequest $request, $id)
    {
        $pagoLote = $this->pagoLoteRepo->update($request->validated(), $id);
        return response()->json($pagoLote);
    }

    // Eliminar un pago
    public function destroy($id)
    {
        $this->pagoLoteRepo->delete($id);
        return response()->json(null, 204);
    }


    public function filter(Request $request)
    {
        $query = PagoLote::query();

        // Filtrar por predio
        if ($request->filled('idPredio')) {
            $query->where('idPredio', $request->idPredio);
        }

        // Filtrar por lote
        if ($request->filled('idLote')) {
            $query->where('idLote', $request->idLote);
        }

        // Filtrar por contrato
        if ($request->filled('idContrato')) {
            $query->where('idContrato', $request->idContrato);
        }

        $pagos = $query->with(['predio', 'lote', 'cliente', 'usuario'])->paginate(10);

        return view('pago_lotes.index', compact('pagos'));
    }


}
