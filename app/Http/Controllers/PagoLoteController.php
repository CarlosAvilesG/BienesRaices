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
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Auth;

class PagoLoteController extends Controller
{
    protected $pagoLoteRepo;
    protected $predioRepo;
    protected $contratoRepo;
    protected $loteRepo;
    protected $clienteRepo;

// 1. Constructor para inyectar dependencias
    public function __construct(PagoLoteRepositoryInterface $pagoLoteRepo, PredioRepositoryInterface $predioRepo, ContratoRepositoryInterface $contratoRepo, LoteRepositoryInterface $loteRepo, ClienteRepositoryInterface $clienteRepo)
    {
        $this->pagoLoteRepo = $pagoLoteRepo;
        $this->predioRepo = $predioRepo;
        $this->contratoRepo = $contratoRepo;
        $this->loteRepo = $loteRepo;
        $this->clienteRepo = $clienteRepo;
    }
// 2. Métodos relacionados con la vista
    // Mostrar una lista de todos los pagos de lotes
    public function index(Request $request)
    {
        //obtiene el idcontrato y guarda en la variable contratoReq
        $contratoActivo = $this->contratoRepo->findById($request->idContrato);

        // pagoLoteRepo selecciona solo los pagos de lotes que tengan el idContrato con paginacion de 10
        $pagos = $this->pagoLoteRepo->getPagosByContrato($request->idContrato, 10);

         // verificar si en  $this->contratoRepo existen mas contratos con el  $contratoReq->idlote y ordenarlo por fechaPago
        $contratos = $this->contratoRepo->getContratosByLote($contratoActivo->idLote);


        return view('sistema.pago_lotes.index', compact('pagos', 'contratoActivo', 'contratos'));

    }

    public function create()
    {
        return view('sistema.contratos.index');
    }

    public function createByContrato( $contratoId)
    {
        // Obtener el contrato seleccionado
        $contrato = $this->contratoRepo->findById($contratoId);

        // Verificar si el contrato existe
        if (!$contrato) {
            return redirect()->route('pagos-lote.index')->withErrors(['Contrato no encontrado.']);
        }
        // Obtener el lote y cliente asociados al contrato
        $lote = $this->loteRepo->show($contrato->idLote);
        $cliente = $this->clienteRepo->find($contrato->idCliente);

        $fechaActual = now()->format('Y-m-d');
        $horaActual = now()->format('H:i');

        return view('sistema.pago_lotes.create', compact('contrato', 'lote', 'cliente', 'fechaActual', 'horaActual'));
    }

    // Almacenar un nuevo pago en la base de datos
    public function store(StorePagoLoteRequest $request)
    {
        // Asignar el ID del usuario autenticado
      //  $request->merge(['idUsuario' => Auth::id() ]); //Auth::user()->id]);
        $contrato = $this->contratoRepo->findById($request->idContrato);

        if (!$contrato) {
            return redirect()->back()->withErrors(['Contrato no encontrado']);
        }

        $pagoLote = $this->pagoLoteRepo->store($request->validated());



        // return view('sistema.pago_lotes.index', compact('contrato'))->with('success', 'Pago registrado correctamente');
         return redirect()->route('pagos-lote.index', compact('contrato'))->with('success', 'Pago registrado correctamente');
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

 // 4. Métodos auxiliares
 // cancelar pago
    public function cancelarPago(Request $request, $id )
    {
        $pagoLote = PagoLote::find($id);



        if (!$pagoLote) {
            return redirect()->back()->withErrors(['El pago no fue encontrado.']);
        }

       // Verificar si se envió la observación antes de asignarla
        if ($request->has('canceladoObservacion')) {
            $pagoLote->cancelar = 1;
            $pagoLote->observacion = $pagoLote->observacion . "\n" . "Cancelado:".$request->canceladoObservacion;
            $pagoLote->idUsuarioCancela = Auth::id();


            $pagoLote->save();

            return redirect()->route('pagos-lote.index',  ['idContrato' => $pagoLote->idContrato ])->with('success', 'El pago ha sido cancelado correctamente.');


        }

        return redirect()->back()->withErrors(['Debes ingresar una observación.']);
    }
    // Filtrar pagos por predio, lote, o contrato

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

    // Generar un archivo PDF del recibo de pago
    public function generarReciboPagoPDF($id)
    {
        $pago = $this->pagoLoteRepo->findById($id);

       // dd($pagoLote);

        if (!$pago) {
            return redirect()->back()->withErrors(['El pago no fue encontrado.']);
        }

        $pdf = PDF::loadView('sistema.pago_lotes.recibo', compact('pago'));
        return $pdf->download('recibo_pago_' . $pago->id . '.pdf');
    }


}
