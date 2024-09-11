<?php

namespace App\Http\Controllers;

use App\Repository\NegocioRepositoryInterface;
use App\Http\Requests\StoreNegocioRequest;
use App\Http\Requests\UpdateNegocioRequest;

class NegocioController extends Controller
{
    protected $negocioRepo;

    public function __construct(NegocioRepositoryInterface $negocioRepo)
    {
        $this->negocioRepo = $negocioRepo;
    }

    // Mostrar una lista de todos los negocios
    public function index()
    {
        $negocios = $this->negocioRepo->getAll();
        return response()->json($negocios);
    }

    // Guardar un nuevo negocio en la base de datos
    public function store(StoreNegocioRequest $request)
    {
        $negocio = $this->negocioRepo->create($request->validated());
        return response()->json($negocio, 201);
    }

    // Mostrar un negocio específico
    public function show($id)
    {
        $negocio = $this->negocioRepo->findById($id);
        return response()->json($negocio);
    }

    // Actualizar un negocio existente en la base de datos
    public function update(UpdateNegocioRequest $request, $id)
    {
        $negocio = $this->negocioRepo->update($request->validated(), $id);
        return response()->json($negocio, 200);
    }

    // Eliminar un negocio específico de la base de datos
    public function destroy($id)
    {
        $this->negocioRepo->delete($id);
        return response()->json(null, 204);
    }
}
