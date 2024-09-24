<?php

namespace App\Http\Controllers;

use App\Repositories\PagoLoteRepositoryInterface;
use App\Http\Requests\StorePagoLoteRequest;
use App\Http\Requests\UpdatePagoLoteRequest;

class PagoLoteController extends Controller
{
    protected $pagoLoteRepo;

    public function __construct(PagoLoteRepositoryInterface $pagoLoteRepo)
    {
        $this->pagoLoteRepo = $pagoLoteRepo;
    }

    // Mostrar una lista de todos los pagos de lotes
    public function index()
    {
        $pagos = $this->pagoLoteRepo->getAll();
        return response()->json($pagos);
    }

    // Almacenar un nuevo pago en la base de datos
    public function store(StorePagoLoteRequest $request)
    {
        $pagoLote = $this->pagoLoteRepo->create($request->validated());
        return response()->json($pagoLote, 201);
    }

    // Mostrar un pago específico
    public function show($id)
    {
        $pagoLote = $this->pagoLoteRepo->findById($id);
        return response()->json($pagoLote);
    }

    // Actualizar un pago existente
    public function update(UpdatePagoLoteRequest $request, $id)
    {
        $pagoLote = $this->pagoLoteRepo->update($request->validated(), $id);
        return response()->json($pagoLote);
    }

    // Eliminar un pago
    public function destroy($id)
    {
        $this->pagoLoteRepo->delete($id);
        return response()->json(null, 204);
    }
}
