<?php

namespace App\Http\Controllers;

use App\Repositories\ContratoRepositoryInterface;
use App\Repositories\ClienteRepositoryInterface;
use App\Repositories\LoteRepositoryInterface;
use App\Http\Requests\StoreContratoRequest;
use App\Http\Requests\UpdateContratoRequest;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    protected $contratoRepository;
    protected $clienteRepository;
    protected $loteRepository;

    public function __construct(
        ContratoRepositoryInterface $contratoRepository,
        ClienteRepositoryInterface $clienteRepository,
        LoteRepositoryInterface $loteRepository
    ) {
        $this->contratoRepository = $contratoRepository;
        $this->clienteRepository = $clienteRepository;
        $this->loteRepository = $loteRepository;
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


        return view('sistema.contratos.form', compact('clientes', 'lotes'));
    }

    // Almacenar un nuevo contrato
    public function store(StoreContratoRequest $request)
    {
        // Convertir identificadorContrato a mayúsculas antes de almacenar
        $request->merge(['identificadorContrato' => strtoupper($request->identificadorContrato)]);

        $contrato = $this->contratoRepository->create($request->validated());

        return redirect()->route('sistema.contratos.index')->with('success', 'Contrato creado con éxito.');
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

        $clientes = $this->clienteRepository->getAll();
       //obtener los lotes con id de contrato de $contrato = $this->contratoRepository->findById($id);
        $lotes = $this->loteRepository->getLoteByContrato( $contrato->id);

        //  dd(  $contrato,$clientes, $lotes);
        // Verificar si el lote fue encontrado
        if (!$lotes) {
            return redirect()->route('contratos.index')->with('error', 'No se encontraron lotes relacionados con este contrato.');
        }

        return view('sistema.contratos.form', compact('contrato', 'clientes', 'lotes'));
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
}
