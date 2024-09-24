<?php

namespace App\Http\Controllers;

use App\Repositories\FraseEticaRepositoryInterface;
use App\Http\Requests\StoreFraseEticaRequest;
use App\Http\Requests\UpdateFraseEticaRequest;

class FraseEticaController extends Controller
{
    protected $fraseEticaRepo;

    public function __construct(FraseEticaRepositoryInterface $fraseEticaRepo)
    {
        $this->fraseEticaRepo = $fraseEticaRepo;
    }

    // Mostrar una lista de todas las frases éticas
    public function index()
    {
        $frases = $this->fraseEticaRepo->getAll();
        return response()->json($frases);
    }

    // Almacenar una nueva frase ética en la base de datos
    public function store(StoreFraseEticaRequest $request)
    {
        $frase = $this->fraseEticaRepo->store($request->validated());
        return response()->json($frase, 201);
    }

    // Mostrar una frase ética específica
    public function show($id)
    {
        $frase = $this->fraseEticaRepo->show($id);
        return response()->json($frase);
    }

    // Actualizar una frase ética existente
    public function update(UpdateFraseEticaRequest $request, $id)
    {
        $frase = $this->fraseEticaRepo->update($request->validated(), $id);
        return response()->json($frase);
    }

    // Eliminar una frase ética
    public function destroy($id)
    {
        $this->fraseEticaRepo->delete($id);
        return response()->json(null, 204);
    }

    // Obtener una frase ética de manera aleatoria
    public function random()
    {
        $frase = $this->fraseEticaRepo->getRandom();
        return response()->json($frase);
    }
}
