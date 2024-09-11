<?php

namespace App\Http\Controllers;

use App\Repository\MorosoRepositoryInterface;
use App\Http\Requests\StoreMorosoRequest;
use App\Http\Requests\UpdateMorosoRequest;

class MorosoController extends Controller
{
    protected $morosoRepo;

    public function __construct(MorosoRepositoryInterface $morosoRepo)
    {
        $this->morosoRepo = $morosoRepo;
    }

    // Mostrar una lista de todos los morosos
    public function index()
    {
        $morosos = $this->morosoRepo->getAll();
        return response()->json($morosos);
    }

    // Guardar un nuevo moroso en la base de datos
    public function store(StoreMorosoRequest $request)
    {
        $moroso = $this->morosoRepo->create($request->validated());
        return response()->json($moroso, 201);
    }

    // Mostrar un moroso específico
    public function show($id)
    {
        $moroso = $this->morosoRepo->findById($id);
        return response()->json($moroso);
    }

    // Actualizar un moroso existente en la base de datos
    public function update(UpdateMorosoRequest $request, $id)
    {
        $moroso = $this->morosoRepo->update($request->validated(), $id);
        return response()->json($moroso, 200);
    }

    // Eliminar un moroso específico de la base de datos
    public function destroy($id)
    {
        $this->morosoRepo->delete($id);
        return response()->json(null, 204);
    }
}
