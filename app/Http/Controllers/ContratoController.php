<?php

namespace App\Http\Controllers;

use App\Repositories\ContratoRepositoryInterface;
use App\Repositories\ClienteRepositoryInterface;
use App\Repositories\LoteRepositoryInterface;
use App\Repositories\PredioRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\BitacoraRepositoryInterface;

use App\Http\Requests\StoreContratoRequest;
use App\Http\Requests\UpdateContratoRequest;
use Illuminate\Http\Request; // Esta es la importación correcta de Request
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Helpers\GeneralHelper;


class ContratoController extends Controller
{
    protected $contratoRepository;
    protected $clienteRepository;
    protected $loteRepository;
    protected $predioRepository;
    protected $userRepository;
    protected $bitacoraRepository;

    protected $setAuditReason;

    public function __construct(
        ContratoRepositoryInterface $contratoRepository,
        ClienteRepositoryInterface $clienteRepository,
        LoteRepositoryInterface $loteRepository,
        PredioRepositoryInterface $predioRepository,
        UserRepositoryInterface $userRepository,
        BitacoraRepositoryInterface $bitacoraRepository,
    ) {
        $this->contratoRepository = $contratoRepository;
        $this->clienteRepository = $clienteRepository;
        $this->loteRepository = $loteRepository;
        $this->predioRepository = $predioRepository;
        $this->userRepository = $userRepository;
        $this->bitacoraRepository = $bitacoraRepository;
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
        $request->merge(['precioPredio' => $precioLote]);

        // para calcular el número de letras basado en años y temporalidad (MENSUAL O QUINCENAL)
        $request->merge(['noLetras' => (int) $request->noAnios * ($request->convenioTemporalidadPago == 'Quincenal' ? 24 : 12)]);

        // Asignar el ID del usuario autenticado
        $request->merge(['idUsuario' => Auth::user()->id]);

        // Validar que Anualidades no sea mayor que NoAnios
        if ($request->anualidades > $request->noAnios) {
            return redirect()->back()->withErrors(['anualidades' => 'El campo Anualidades no puede ser mayor que el tiempo del contrato.'])->withInput();
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

    // Cambiar el estado de un contrato a cancelado
    public function cancelarContrato(Request  $request, $id)
    {
        $contrato =  $this->contratoRepository->findById($id);

        // Validar que se reciba la observación de cancelación
        $request->validate([
            'canceladoObservacion' => 'required|string|max:255'
        ]);

        // Cambiar el estatus a "Cancelado"
        $contrato->estatus = 'Cancelado';
        $contrato->canceladoObservacion = $request->canceladoObservacion; // Guardar la observación de cancelación
        $contrato->idUsuCancela = Auth::user()->id; // Guardar el ID del usuario que cancela
        $contrato->save();

        // Opcionalmente, agregar la entrada en la bitácora usando tu sistema de auditoría
        $contrato->setAuditReason('Contrato cancelado con observación: ' . $request->cancelacion_observacion);
        $contrato->save();

        return redirect()->route('contratos.index')->with('success', 'Contrato cancelado exitosamente.');
    }


    // Eliminar un contrato
    public function destroy($id)
    {
        $this->contratoRepository->delete($id);
        return redirect()->route('sistema.contratos.index')->with('success', 'Contrato eliminado con éxito.');
    }

    public function generarPromesaVentaPDF($contratoId)
    {
        // Obtener el contrato y sus relaciones
        $contrato =  $this->contratoRepository->findById($contratoId);
        $lote = $contrato->lote;
        $predio = $lote->predio;
        $cliente = $contrato->cliente;  // Obtener el cliente completo
        $usurio =  $contrato->usuario;

        // Buscar al usuario con rol de 'vendedor_autorizado'
        //  $usuarioVendedor = User::role('vendedor_autorizado')->first();
        $usuarioVendedor = $this->userRepository->findUserByRole('propietario');


        // dd(Auth::user());
        //obtener el usuario con rol propetario
        //  $usurio = $this->contratoRepository->getUsuarioPropietario($contratoId);

        // Formatear el precio en formato de moneda
        $precioFormateado = number_format($contrato->precioPredio, 2, '.', ',');  // Ejemplo: $638,179.78

        // Generar la representación del precio en letras
        $precioEnLetras = GeneralHelper::convertirNumeroALetras($contrato->precioPredio);

        // Datos a enviar a la vista
        $contratoData = [
            'cliente' => $cliente->nombre . ' ' . $cliente->paterno . ' ' . $cliente->materno,  // Nombre completo
            'vendedor' =>  $usuarioVendedor->nombre . ' ' . $usuarioVendedor->paterno . ' ' . $usuarioVendedor->materno, //'Nombre del Vendedor',  // Si hay un vendedor asociado
            'precio' =>  $precioFormateado,
            'precioLetras' => ucfirst($precioEnLetras) . ' M.N.',  // Precio en letras con formato correcto
            'letras' => $contrato->noLetras,
            'interes' => $contrato->interesMoroso,
            'temporalidad' => $contrato->convenioTemporalidadPago,
            'viaPago' => $contrato->convenioViaPago,
            'plazo' => $contrato->noLetras,  // Ajusta según sea necesario
            'observacion' => $contrato->observacion,
            'ciudad' => 'La Paz',  // Ciudad por defecto o dinámica
            'montoEnganche' => $contrato->enganche,
            'montoAnualidad' => $contrato->pagoAnualidad,
            'anualidades' => $contrato->anualidades,
            'montoFinanciar' => $contrato->precioPredio - $contrato->enganche,
        ];

        // objeto lote
        $loteData = [

            'manzana' => $lote->manzana,
            'lote' => $lote->lote,
            'metrosCuadrados' => $lote->metrosCuadrados,

        ];

        // objeto predio
        $predioData = [

            'nombre' => $predio->nombre,
            'descripcion' => $predio->descripcion,
            'claveCatastral' => $predio->claveCatastral,
            'notaria' => $predio->notaria,
            'numeroEscritura' => $predio->numeroEscritura,
            'folioEscritura' => $predio->folioEscritura,
            'volumenEscritura' => $predio->volumenEscritura,
            'coordenadasNorte' => $predio->coordenadasNorte,
            'coordenadasSur' => $predio->coordenadasSur,
            'coordenadasEste' => $predio->coordenadasEste,
            'coordenadasOeste' => $predio->coordenadasOeste,

        ];

        // También enviar el objeto del cliente completo
        $clienteData = [
            'curp' => $cliente->curp,
            'rfc' => $cliente->rfc,
            'direccion' => $cliente->direccion,
            'colonia' => $cliente->colonia,
            'municipio' => $cliente->municipio,
            'estadoRepublica' => $cliente->estadoRepublica,
            'codigoPostal' => $cliente->codigoPostal,
        ];

        // Datos de la amortización (ejemplo sencillo)
        $montoFinanciar = $contrato->precioPredio - $contrato->enganche;  // Monto a financiar
        $interesAnual = 0; // $contrato->InteresMoroso;   // Tasa de interés anual
        $numPagos = $contrato->noLetras;            // Número de pagos

        $amortizacion = $this->generarTablaAmortizacion($montoFinanciar, $interesAnual, $numPagos, $contrato->anualidades, $contrato->pagoAnualidad);

        // // utilica Repositories Bitacora para guardar la bitacora de la generacion de la promesa de venta
        //  $this->bitacoraRepository->create([
        //     'fecha' => now(),
        //     'usuario' => Auth::user()->id,
        //     'tabla' => 'contratos',
        //     'tipoOperacion' => 'Generación de promesa de venta',
        //     'campoLlave' => $contrato->id,
        //     'descripcion' => 'Se generó la promesa de venta del contrato ' . $contrato->identificadorContrato,
        //     'ip' => request()->ip(),
        //     'user_agent' => request()->userAgent(),
        // ]);



        // Generar el PDF con la vista y los datos
        $pdf = PDF::loadView('sistema.contratos.promesa_venta_pdf', compact('contratoData', 'clienteData', 'loteData', 'predioData', 'amortizacion'));

        // Retornar el PDF generado para descarga o vista previa
        return $pdf->download('Promesa_Compra_Venta.pdf');
    }

    private function generarTablaAmortizacion($monto, $interesAnual, $numPagos, $anualidades = 0, $pagoAnualidad = 0)
    {
        $amortizacion = [];
        $saldo = $monto;
        $interesMensual = $interesAnual / 12 / 100;

        // Si no hay interés, dividir el monto en cuotas iguales
        $cuotaMensual = ($interesAnual > 0)
            ? ($saldo * $interesMensual) / (1 - pow(1 + $interesMensual, -$numPagos))
            : $monto / $numPagos;

        $contadorAnualidades = 0;  // Para controlar cuántas anualidades se han aplicado

        for ($i = 1; $i <= $numPagos; $i++) {
            $interes = $saldo * $interesMensual;
            $capital = $cuotaMensual - $interes;
            $saldo -= $capital;

            // Guardar la cuota mensual normal primero
            $amortizacion[] = [
                'numero' => $i,
                'fecha' => now()->addMonths($i)->format('d/m/Y'),
                'cuota' => $cuotaMensual,
                'interes' => $interes,
                'capital' => $capital,
                'saldo' => $saldo > 0 ? $saldo : 0,
            ];

            // Aplicar la anualidad si corresponde, y si aún quedan anualidades por aplicar
            if ($anualidades > 0 && $contadorAnualidades < $anualidades && $i % 12 == 0) {
                $saldo -= $pagoAnualidad;  // Reducir el saldo con el pago de anualidad

                // Añadir el pago de la anualidad
                $amortizacion[] = [
                    'numero' => "$i (Anualidad)",  // Indicar que es la anualidad
                    'fecha' => now()->addMonths($i)->format('d/m/Y'),  // La misma fecha que el mes de la cuota
                    'cuota' => $pagoAnualidad,
                    'interes' => 0,  // No hay interés en el pago de la anualidad
                    'capital' => $pagoAnualidad,
                    'saldo' => $saldo > 0 ? $saldo : 0,
                ];

                $contadorAnualidades++;  // Incrementar el contador de anualidades aplicadas
            }
        }

        return $amortizacion;
    }


}
