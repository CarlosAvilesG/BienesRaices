<?php

namespace App\Http\Controllers;

use App\Repositories\ContratoRepositoryInterface;
use App\Repositories\ClienteRepositoryInterface;
use App\Repositories\LoteRepositoryInterface;
use App\Repositories\PredioRepositoryInterface;
use App\Http\Requests\StoreContratoRequest;
use App\Http\Requests\UpdateContratoRequest;
use App\Models\Predio;
use App\Repositories\PredioRepository;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Auth;
use App\Helpers\GeneralHelper;

class ContratoController extends Controller
{
    protected $contratoRepository;
    protected $clienteRepository;
    protected $loteRepository;
    protected $predioRepository;

    public function __construct(
        ContratoRepositoryInterface $contratoRepository,
        ClienteRepositoryInterface $clienteRepository,
        LoteRepositoryInterface $loteRepository,
        PredioRepositoryInterface $predioRepository
    ) {
        $this->contratoRepository = $contratoRepository;
        $this->clienteRepository = $clienteRepository;
        $this->loteRepository = $loteRepository;
        $this->predioRepository = $predioRepository;
    }

    // probar si funciona
    // public function test()
    // {
    //     return $this->loteRepository->getLoteByContrato(1);
    // }
    // Mostrar una lista de todos los contratos
    public function index()
    {
        $contratos = $this->contratoRepository->getAll();
        return view('sistema.contratos.index', compact('contratos'));
    }

    // Mostrar el formulario para crear un nuevo contrato
    public function create()
    {
        $clientes = $this->clienteRepository->getAll(); // Obtener todos los clientes
        $lotes = $this->loteRepository->getAvailableLotes(); // Obtener lotes disponibles (sin contrato)
        $predios = $this->predioRepository->getAll(); // Obtener todos los predios

        return view('sistema.contratos.create', compact('clientes', 'lotes', 'predios'));
    }

    // Almacenar un nuevo contrato
    public function store(StoreContratoRequest $request)
    {
        // Convertir identificadorContrato a mayúsculas antes de almacenar
        $request->merge(['identificadorContrato' => strtoupper($request->identificadorContrato)]);

        // Convertir el precio al formato numérico (por si viene en formato de moneda)
        $precio = str_replace([',', '$'], '', $request->input('PrecioPredio'));

        // Agregar el precio convertido al request
        $request->merge(['PrecioPredio' => $precio]);

        // Asignar el ID del usuario autenticado
        $request->merge(['idUsuario' => Auth::user()->id]);

        // Asignar fecha y hora de registro automáticamente
        $request->merge([
            'FechaRegistro' => now()->format('Y-m-d'),
            'HoraRegistro' => now()->format('H:i:s'),
    ]);

    // Validar los datos después de haber manipulado el request
    $validatedData = $request->validated();

    // Crear el contrato usando los datos validados
    $contrato = $this->contratoRepository->create($validatedData);

    // Redirigir a la vista 'show' después de guardar el contrato
    return redirect()->route('contratos.show', $contrato->id)
        ->with('success', 'El contrato ha sido creado exitosamente.');
    }

    // Mostrar un contrato específico
    public function show($id)
    {
        $contrato = $this->contratoRepository->findById($id);
        return view('sistema.contratos.show', compact('contrato'));
    }

    // Mostrar el formulario para editar un contrato
    public function edit($id)
    {
        $contrato = $this->contratoRepository->findById($id);

        // Verificar si el contrato fue encontrado
        if (!$contrato) {
            return redirect()->route('contratos.index')->with('error', 'Contrato no encontrado.');
        }

        $clientes = $this->clienteRepository->find($contrato->idCliente);
        $lotes = $this->loteRepository->show($contrato->idLote);
        $predios = $this->loteRepository->show($contrato->idPredio);

        //  dd(  $contrato,$clientes, $lotes);
        // Verificar si el lote fue encontrado
        if (!$lotes) {
            return redirect()->route('contratos.index')->with('error', 'No se encontraron lotes relacionados con este contrato.');
        }

        return view('sistema.contratos.edit', compact('contrato', 'clientes', 'lotes', 'predios'));
        // return view('sistema.contratos.edit', compact('contrato', 'clientes', 'lotes', 'predios'));
    }

    // Actualizar un contrato existente
    public function update(UpdateContratoRequest $request, $id)
    {
        $contrato = $this->contratoRepository->update($id, $request->validated());
        return redirect()->route('sistema.contratos.index')->with('success', 'Contrato actualizado con éxito.');
    }

    // Eliminar un contrato
    public function destroy($id)
    {
        $this->contratoRepository->delete($id);
        return redirect()->route('sistema.contratos.index')->with('success', 'Contrato eliminado con éxito.');
    }

    public function generarPromesaVentaPDF($contratoId)
    {
        // Supongamos que obtienes los datos del contrato y lote de la base de datos
        $contrato =  $this->contratoRepository->findById($contratoId);
        //obtener el predio por el id de predio
        // $predio = Predio::find($contrato->idPredio);

        $contratoData = [
            'cliente' => $contrato->cliente->nombre . ' ' . $contrato->cliente->paterno . ' ' . $contrato->cliente->materno,
            'vendedor' => 'Nombre del Vendedor',  // Aquí puedes agregar el nombre del vendedor si está en otra tabla o directamente
            'lote' => [
                'manzana' => $contrato->lote->manzana,
                'lote' => $contrato->lote->lote,
                'metrosCuadrados' => $contrato->lote->metrosCuadrados,
            ],
            'predio' => $contrato->lote->predio->nombre,  // Asegúrate de tener la relación Predio en el modelo Lote
            'precio' => $contrato->PrecioPredio,
            'letras' => $contrato->NoLetras,
            'interes' => $contrato->InteresMoroso,
            'temporalidad' => $contrato->ConvenioTemporalidadPago,
            'viaPago' => $contrato->ConvenioViaPago,
            'plazo' => '12 meses',  // Puedes personalizar este valor según tu lógica
            'observacion' => $contrato->observacion,
            'ciudad' => 'La Paz',  // Ciudad por defecto o dinámica
        ];

        // Generar el PDF con la vista y los datos
        $pdf = PDF::loadView('contratos.promesa_venta_pdf', compact('contratoData'));

        // Retornar el PDF generado para descarga o vista previa
        return $pdf->download('Promesa_Compra_Venta.pdf');
    }
}
