<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Repositories\ClienteRepositoryInterface;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller; // Ensure this import is present

class ClienteController extends Controller
{
    protected $clienteRepository;

    public function __construct(ClienteRepositoryInterface $clienteRepository)
    {

        $this->clienteRepository = $clienteRepository;
    }

    // Mostrar una lista de todos los clientes
    public function index()
    {
        //return view('clientes.index');

        $clientes = $this->clienteRepository->getAll();
        //return response()->json($clientes);

        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    // Guardar un nuevo cliente en la base de datos
    public function store(StoreClienteRequest $request)
    {
        // Obtener los datos validados del Request
        $validatedData = $request->validated();

        // Crear un nuevo cliente usando el repositorio
        $cliente = $this->clienteRepository->store($validatedData);

        return response()->json($cliente, 201);
    }

    // Mostrar un cliente específico
    public function show($id)
    {
        $cliente = $this->clienteRepository->find($id);
        return response()->json($cliente);
    }

    // Actualizar un cliente existente en la base de datos
    public function update(UpdateClienteRequest $request, $id)
    {
        // Obtener los datos validados del Request
        $validatedData = $request->validated();

        // Actualizar cliente usando el repositorio
        $cliente = $this->clienteRepository->update($id, $validatedData);

        return response()->json($cliente, 200);
    }

    // Eliminar un cliente específico de la base de datos
    public function destroy($id)
    {
        $this->clienteRepository->delete($id);
        return response()->json(null, 204);
    }
}
