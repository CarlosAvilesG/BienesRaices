<?php

namespace App\Http\Controllers;

use App\Models\Moroso;
use Illuminate\Http\Request;

class MorosoController extends Controller
{
    // Mostrar una lista de todos los morosos
    public function index()
    {
        $morosos = Moroso::all();
        return response()->json($morosos);
    }

    // Guardar un nuevo moroso en la base de datos
    public function store(Request $request)
    {
        // Validaciones
        $validatedData = $request->validate([
            'idCliente' => 'required|exists:clientes,idCliente',
            'montoDeuda' => 'required|numeric|min:0',
            'activo' => 'boolean',
            'fecha_inicio' => 'required|date',
            'fecha_resolucion' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        // Crear un nuevo registro
        $moroso = Moroso::create($validatedData);

        return response()->json($moroso, 201);
    }

    // Mostrar un moroso específico
    public function show($id)
    {
        $moroso = Moroso::findOrFail($id);
        return response()->json($moroso);
    }

    // Actualizar un moroso existente en la base de datos
    public function update(Request $request, $id)
    {
        // Validaciones
        $validatedData = $request->validate([
            'idCliente' => 'sometimes|required|exists:clientes,idCliente',
            'montoDeuda' => 'sometimes|required|numeric|min:0',
            'activo' => 'boolean',
            'fecha_inicio' => 'sometimes|required|date',
            'fecha_resolucion' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        // Buscar y actualizar el registro
        $moroso = Moroso::findOrFail($id);
        $moroso->update($validatedData);

        return response()->json($moroso, 200);
    }

    // Eliminar un moroso específico de la base de datos
    public function destroy($id)
    {
        $moroso = Moroso::findOrFail($id);
        $moroso->delete();

        return response()->json(null, 204);
    }
}
