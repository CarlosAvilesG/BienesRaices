<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePredioRequest;
use App\Http\Requests\UpdatePredioRequest;
use App\Repositories\PredioRepositoryInterface;

class PredioController extends Controller
{
    protected $predioRepo;

    public function __construct(PredioRepositoryInterface $predioRepo)
    {
        $this->predioRepo = $predioRepo;
    }

    // Mostrar una lista de todos los predios
    public function index()
    {
        $predios = $this->predioRepo->getAllPredios();
        return response()->json($predios);
    }

    // Almacenar un nuevo predio en la base de datos
    public function store(StorePredioRequest $request)
    {
        $predio = $this->predioRepo->createPredio($request->validated());
        return response()->json($predio, 201);
    }

    // Mostrar un predio específico
    public function show($id)
    {
        $predio = $this->predioRepo->findPredioById($id);
        return response()->json($predio);
    }

    // Actualizar un predio existente
    public function update(UpdatePredioRequest $request, $id)
    {
        $predio = $this->predioRepo->updatePredio($id, $request->validated());
        return response()->json($predio);
    }

    // Eliminar un predio
    public function destroy($id)
    {
        $this->predioRepo->deletePredio($id);
        return response()->json(null, 204);
    }
}
