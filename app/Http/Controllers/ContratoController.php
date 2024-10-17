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
use Barryvdh\DomPDF\Facade\Pdf;
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

        // Obtener el precio del lote seleccionado
        $lotes = $this->loteRepository->show($request->idLote);
         // Asegúrate de eliminar el formato de moneda (símbolo de $ y comas) del precio
        $precioLote = str_replace([',', '$'], '', $lotes->precio);
        $request->merge(['PrecioPredio' => $precioLote]);

        // para calcular el número de letras basado en años y temporalidad (MENSUAL O QUINCENAL)
        $request->merge(['NoLetras' => (int) $request->NoAnios * ($request->ConvenioTemporalidadPago == 'Quincenal' ? 24 : 12)]);

        // Asignar el ID del usuario autenticado
        $request->merge(['idUsuario' => Auth::user()->id]);

        // Validar que Anualidades no sea mayor que NoAnios
        if ($request->Anualidades > $request->NoAnios) {
            return redirect()->back()->withErrors(['Anualidades' => 'El campo Anualidades no puede ser mayor que el tiempo del contrato.'])->withInput();
        }

        // Validar los datos después de haber manipulado el request
        $validatedData = $request->validated();

        // Asegúrate de que `idUsuario` esté presente en los datos validados
        $validatedData['idUsuario'] = $request->idUsuario;


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
        $predio = Predio::find($contrato->idPredio);

        // Formatear el precio en número con formato de moneda
        $precioFormateado = number_format($contrato->PrecioPredio, 2, '.', ',');  // Formato $638,179.78

        $contratoData = [
            'cliente' => $contrato->cliente->nombre . ' ' . $contrato->cliente->paterno . ' ' . $contrato->cliente->materno,
            'vendedor' => 'Nombre del Vendedor',  // Aquí puedes agregar el nombre del vendedor si está en otra tabla o directamente
            'lote' => [
                'manzana' => $contrato->lote->manzana,
                'lote' => $contrato->lote->lote,
                'metrosCuadrados' => $contrato->lote->metrosCuadrados,
            ],
            'predio' => $contrato->lote->predio->nombre,  // Asegúrate de tener la relación Predio en el modelo Lote

            'precio' => '$'.$precioFormateado, // $contrato->PrecioPredio,
            'letras' => $contrato->NoLetras,
            'interes' => $contrato->InteresMoroso,
            'temporalidad' => $contrato->ConvenioTemporalidadPago,
            'viaPago' => $contrato->ConvenioViaPago,
            'plazo' =>  '12 meses',  // Puedes personalizar este valor según tu lógica
            'observacion' => $contrato->observacion,
            'ciudad' => 'La Paz',  // Ciudad por defecto o dinámica
            'precioLetras' => GeneralHelper::convertirNumeroALetras($contrato->PrecioPredio),
        ];


        // Generar el PDF con la vista y los datos
        $pdf = PDF::loadView('sistema.contratos.promesa_venta_pdf', compact('contratoData'));

        // Retornar el PDF generado para descarga o vista previa
        return $pdf->download('Promesa_Compra_Venta.pdf');
    }
}
