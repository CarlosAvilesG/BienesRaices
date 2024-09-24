<?php

namespace App\Http\Controllers;

use App\Repositories\CorteCajaDetalleRepositoryInterface;
use App\Http\Requests\StoreCorteCajaDetalleRequest;
use App\Http\Requests\UpdateCorteCajaDetalleRequest;

class CorteCajaDetalleController extends Controller
{
    protected $corteCajaDetalleRepo;

    public function __construct(CorteCajaDetalleRepositoryInterface $corteCajaDetalleRepo)
    {
        $this->corteCajaDetalleRepo = $corteCajaDetalleRepo;
    }

    // Mostrar una lista de todos los detalles de corte de caja
    public function index()
    {
        $detalles = $this->corteCajaDetalleRepo->getAll();
        return response()->json($detalles);
    }

    // Almacenar un nuevo detalle de corte de caja en la base de datos
    public function store(StoreCorteCajaDetalleRequest $request)
    {
        $detalle = $this->corteCajaDetalleRepo->store($request->validated());
        return response()->json($detalle, 201);
    }

    // Mostrar un detalle de corte de caja específico
    public function show($id)
    {
        $detalle = $this->corteCajaDetalleRepo->show($id);
        return response()->json($detalle);
    }

    // Actualizar un detalle de corte de caja existente
    public function update(UpdateCorteCajaDetalleRequest $request, $id)
    {
        $detalle = $this->corteCajaDetalleRepo->update($request->validated(), $id);
        return response()->json($detalle);
    }

    // Eliminar un detalle de corte de caja
    public function destroy($id)
    {
        $this->corteCajaDetalleRepo->delete($id);
        return response()->json(null, 204);
    }
}
