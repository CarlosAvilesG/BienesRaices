<?php

namespace App\Http\Controllers;

use App\Repositories\BitacoraRepositoryInterface;
use App\Http\Requests\StoreBitacoraRequest;
use App\Http\Requests\UpdateBitacoraRequest;

class BitacoraController extends Controller
{
    protected $bitacoraRepository;

    public function __construct(BitacoraRepositoryInterface $bitacoraRepository)
    {
        $this->bitacoraRepository = $bitacoraRepository;
    }

    // Mostrar una lista de todos los registros de la bitácora
    public function index()
    {
        $bitacoras = $this->bitacoraRepository->getAll();
        return response()->json($bitacoras);
    }

    // Almacenar un nuevo registro en la bitácora
    public function store(StoreBitacoraRequest $request)
    {
        $bitacora = $this->bitacoraRepository->create($request->validated());
        return response()->json($bitacora, 201);
    }

    // Mostrar un registro específico de la bitácora
    public function show($id)
    {
        $bitacora = $this->bitacoraRepository->findById($id);
        return response()->json($bitacora);
    }

    // Actualizar un registro existente de la bitácora
    public function update(UpdateBitacoraRequest $request, $id)
    {
        $bitacora = $this->bitacoraRepository->update($id, $request->validated());
        return response()->json($bitacora);
    }

    // Eliminar un registro de la bitácora
    public function destroy($id)
    {
        $this->bitacoraRepository->delete($id);
        return response()->json(null, 204);
    }


}
