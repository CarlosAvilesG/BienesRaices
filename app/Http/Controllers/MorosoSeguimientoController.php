<?php

namespace App\Http\Controllers;

use App\Repositories\MorosoSeguimientoRepositoryInterface;
use App\Http\Requests\StoreMorosoSeguimientoRequest;
use App\Http\Requests\UpdateMorosoSeguimientoRequest;

class MorosoSeguimientoController extends Controller
{
    protected $seguimientoRepo;

    public function __construct(MorosoSeguimientoRepositoryInterface $seguimientoRepo)
    {
        $this->seguimientoRepo = $seguimientoRepo;
    }

    // Mostrar una lista de todos los seguimientos
    public function index()
    {
        $seguimientos = $this->seguimientoRepo->getAll();
        return response()->json($seguimientos);
    }

    // Guardar un nuevo seguimiento en la base de datos
    public function store(StoreMorosoSeguimientoRequest $request)
    {
        $seguimiento = $this->seguimientoRepo->create($request->validated());
        return response()->json($seguimiento, 201);
    }

    // Mostrar un seguimiento específico
    public function show($id)
    {
        $seguimiento = $this->seguimientoRepo->findById($id);
        return response()->json($seguimiento);
    }

    // Actualizar un seguimiento existente en la base de datos
    public function update(UpdateMorosoSeguimientoRequest $request, $id)
    {
        $seguimiento = $this->seguimientoRepo->update($request->validated(), $id);
        return response()->json($seguimiento, 200);
    }

    // Eliminar un seguimiento específico de la base de datos
    public function destroy($id)
    {
        $this->seguimientoRepo->delete($id);
        return response()->json(null, 204);
    }
}
