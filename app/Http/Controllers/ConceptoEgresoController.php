<?php

namespace App\Http\Controllers;

use App\Repositories\ConceptoEgresoRepositoryInterface;
use App\Http\Requests\StoreConceptoEgresoRequest;
use App\Http\Requests\UpdateConceptoEgresoRequest;

class ConceptoEgresoController extends Controller
{
    protected $conceptoEgresoRepository;

    public function __construct(ConceptoEgresoRepositoryInterface $conceptoEgresoRepository)
    {
        $this->conceptoEgresoRepository = $conceptoEgresoRepository;
    }

    // Mostrar una lista de todos los conceptos de egreso
    public function index()
    {
        $conceptos = $this->conceptoEgresoRepository->getAll();
        return response()->json($conceptos);
    }

    // Almacenar un nuevo concepto de egreso en la base de datos
    public function store(StoreConceptoEgresoRequest $request)
    {
        $concepto = $this->conceptoEgresoRepository->create($request->validated());
        return response()->json($concepto, 201);
    }

    // Mostrar un concepto de egreso específico
    public function show($id)
    {
        $concepto = $this->conceptoEgresoRepository->findById($id);
        return response()->json($concepto);
    }

    // Actualizar un concepto de egreso existente
    public function update(UpdateConceptoEgresoRequest $request, $id)
    {
        $concepto = $this->conceptoEgresoRepository->update($id, $request->validated());
        return response()->json($concepto);
    }

    // Eliminar un concepto de egreso
    public function destroy($id)
    {
        $this->conceptoEgresoRepository->delete($id);
        return response()->json(null, 204);
    }
}
