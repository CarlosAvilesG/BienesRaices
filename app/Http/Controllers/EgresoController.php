<?php

namespace App\Http\Controllers;

use App\Repositories\EgresoRepositoryInterface;
use App\Http\Requests\StoreEgresoRequest;
use App\Http\Requests\UpdateEgresoRequest;

class EgresoController extends Controller
{
    protected $egresoRepo;

    public function __construct(EgresoRepositoryInterface $egresoRepo)
    {
        $this->egresoRepo = $egresoRepo;
    }

    // Mostrar una lista de todos los egresos
    public function index()
    {
        $egresos = $this->egresoRepo->getAll();
        return response()->json($egresos);
    }

    // Almacenar un nuevo egreso en la base de datos
    public function store(StoreEgresoRequest $request)
    {
        $egreso = $this->egresoRepo->store($request->validated());
        return response()->json($egreso, 201);
    }

    // Mostrar un egreso específico
    public function show($id)
    {
        $egreso = $this->egresoRepo->show($id);
        return response()->json($egreso);
    }

    // Actualizar un egreso existente
    public function update(UpdateEgresoRequest $request, $id)
    {
        $egreso = $this->egresoRepo->update($request->validated(), $id);
        return response()->json($egreso);
    }

    // Eliminar un egreso
    public function destroy($id)
    {
        $this->egresoRepo->delete($id);
        return response()->json(null, 204);
    }
}
