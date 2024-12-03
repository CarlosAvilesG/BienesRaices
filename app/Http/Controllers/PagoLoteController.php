<?php

namespace App\Http\Controllers;

use App\Repositories\PagoLoteRepositoryInterface;
use App\Http\Requests\StorePagoLoteRequest;
use App\Http\Requests\UpdatePagoLoteRequest;
use App\Models\Predio;
use App\Models\Lote;
use App\Models\Contrato;
use App\Models\PagoLote;
use Illuminate\Http\Request;

class PagoLoteController extends Controller
{
    protected $pagoLoteRepo;

    public function __construct(PagoLoteRepositoryInterface $pagoLoteRepo)
    {
        $this->pagoLoteRepo = $pagoLoteRepo;
    }

    // Mostrar una lista de todos los pagos de lotes
    public function index(Request $request)
    {
       // $pagos = $this->pagoLoteRepo->getAll();
       // return response()->json($pagos);
        // Obtener los datos de predios, lotes, o contratos si están presentes en la solicitud
        $predios = Predio::all(); // Listar todos los predios
        $lotes = Lote::all();     // Listar todos los lotes
        $contratos = Contrato::all(); // Listar todos los contratos

        $query = PagoLote::query();

        // Filtrar por predio, lote o contrato si están presentes en la solicitud
        if ($request->filled('idPredio')) {
            $query->where('idPredio', $request->idPredio);
        }

        if ($request->filled('idLote')) {
            $query->where('idLote', $request->idLote);
        }

        if ($request->filled('idContrato')) {
            $query->where('idContrato', $request->idContrato);
        }

        // Obtener los pagos filtrados
        $pagos = $query->with(['predio', 'lote', 'cliente', 'usuario'])->paginate(10);

        return view('pago_lotes.index', compact('pagos', 'predios', 'lotes', 'contratos'));
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
