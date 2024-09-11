<?php

namespace App\Http\Controllers;

use App\Models\ClienteReferencia;
use App\Http\Requests\StoreClienteReferenciaRequest;
use App\Http\Requests\UpdateClienteReferenciaRequest;

class ClienteReferenciaController extends Controller
{
    // Mostrar todas las referencias
    public function index()
    {
        $referencias = ClienteReferencia::all();
        return response()->json($referencias);
    }

    // Crear una nueva referencia
    public function store(StoreClienteReferenciaRequest $request)
    {
        $referencia = ClienteReferencia::create($request->validated());
        return response()->json($referencia, 201);
    }

    // Mostrar una referencia específica
    public function show($id)
    {
        $referencia = ClienteReferencia::findOrFail($id);
        return response()->json($referencia);
    }

    // Actualizar una referencia específica
    public function update(UpdateClienteReferenciaRequest $request, $id)
    {
        $referencia = ClienteReferencia::findOrFail($id);
        $referencia->update($request->validated());
        return response()->json($referencia);
    }

    // Eliminar una referencia
    public function destroy($id)
    {
        ClienteReferencia::destroy($id);
        return response()->json(null, 204);
    }
}
