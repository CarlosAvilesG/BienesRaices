<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCorteCajaRequest;
use App\Http\Requests\UpdateCorteCajaRequest;
use App\Repositories\CorteCajaRepositoryInterface;

class CorteCajaController extends Controller
{
    protected $corteCajaRepository;

    public function __construct(CorteCajaRepositoryInterface $corteCajaRepository)
    {
        $this->corteCajaRepository = $corteCajaRepository;
    }

    // Mostrar una lista de todos los cortes de caja
    public function index()
    {
        $cortes = $this->corteCajaRepository->getAll();
        return response()->json($cortes);
    }

    // Almacenar un nuevo corte de caja en la base de datos
    public function store(StoreCorteCajaRequest $request)
    {
        $corte = $this->corteCajaRepository->create($request->validated());
        return response()->json($corte, 201);
    }

    // Mostrar un corte de caja específico
    public function show($id)
    {
        $corte = $this->corteCajaRepository->findById($id);
        return response()->json($corte);
    }

    // Actualizar un corte de caja existente
    public function update(UpdateCorteCajaRequest $request, $id)
    {
        $corte = $this->corteCajaRepository->update($id, $request->validated());
        return response()->json($corte);
    }

    // Eliminar un corte de caja
    public function destroy($id)
    {
        $this->corteCajaRepository->delete($id);
        return response()->json(null, 204);
    }
}
