<?php

namespace App\Http\Controllers;

use App\Models\ClienteReferencia;
use Illuminate\Http\Request;

class ClienteReferenciaController extends Controller
{
    // Mostrar todas las referencias
    public function index()
    {
        $referencias = ClienteReferencia::all();
        return response()->json($referencias);
    }

    // Crear una nueva referencia
    public function store(Request $request)
    {
        $request->validate([
            'idCliente' => 'required|exists:clientes,idCliente',
            'paterno' => 'required|string|max:30',
            'materno' => 'required|string|max:30',
            'nombre' => 'required|string|max:30',
            'telefono' => 'required|string|max:30',
            'trabajo' => 'required|string|max:50',
            'trabajoDireccion' => 'required|string|max:100',
            'trabajoTelefono' => 'required|string|max:30',
        ]);

        $referencia = ClienteReferencia::create($request->all());
        return response()->json($referencia, 201);
    }

    // Mostrar una referencia específica
    public function show($id)
    {
        $referencia = ClienteReferencia::findOrFail($id);
        return response()->json($referencia);
    }

    // Actualizar una referencia específica
    public function update(Request $request, $id)
    {
        $request->validate([
            'paterno' => 'sometimes|required|string|max:30',
            'materno' => 'sometimes|required|string|max:30',
            'nombre' => 'sometimes|required|string|max:30',
            'telefono' => 'sometimes|required|string|max:30',
            'trabajo' => 'sometimes|required|string|max:50',
            'trabajoDireccion' => 'sometimes|required|string|max:100',
            'trabajoTelefono' => 'sometimes|required|string|max:30',
        ]);

        $referencia = ClienteReferencia::findOrFail($id);
        $referencia->update($request->all());
        return response()->json($referencia);
    }

    // Eliminar una referencia
    public function destroy($id)
    {
        ClienteReferencia::destroy($id);
        return response()->json(null, 204);
    }
}
