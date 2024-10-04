<?php

namespace App\Http\Controllers;

use App\Repositories\ContratoRepositoryInterface;
use App\Http\Requests\StoreContratoRequest;
use App\Http\Requests\UpdateContratoRequest;

class ContratoController extends Controller
{
    protected $contratoRepository;


    public function __construct(ContratoRepositoryInterface $contratoRepository)
    {
        $this->contratoRepository = $contratoRepository;
    }

    // Mostrar una lista de todos los contratos
    public function index()
    {
        $contratos = $this->contratoRepository->getAll();
        return response()->json($contratos);
    }

    // Almacenar un nuevo contrato
    public function store(StoreContratoRequest $request)
    {
         // Convertir identificadorContrato a mayúsculas antes de almacenar
        $request->merge(['identificadorContrato' => strtoupper($request->identificadorContrato)]);

        $contrato = $this->contratoRepository->create($request->validated());
        return response()->json($contrato, 201);
    }

    // Mostrar un contrato específico
    public function show($id)
    {
        $contrato = $this->contratoRepository->findById($id);
        return response()->json($contrato);
    }

    // Actualizar un contrato existente
    public function update(UpdateContratoRequest $request, $id)
    {
        $contrato = $this->contratoRepository->update($id, $request->validated());
        return response()->json($contrato);
    }

    // Eliminar un contrato
    public function destroy($id)
    {
        $this->contratoRepository->delete($id);
        return response()->json(null, 204);
    }
}
