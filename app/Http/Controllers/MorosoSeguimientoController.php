<?php

namespace App\Http\Controllers;

use App\Models\MorosoSeguimiento;
use Illuminate\Http\Request;

class MorosoSeguimientoController extends Controller
{
    // Mostrar una lista de todos los seguimientos
    public function index()
    {
        $seguimientos = MorosoSeguimiento::all();
        return response()->json($seguimientos);
    }

    // Guardar un nuevo seguimiento en la base de datos
    public function store(Request $request)
    {
        // Validaciones
        $validatedData = $request->validate([
            'idMoroso' => 'required|exists:morosos,id',
            'fecha_contacto' => 'required|date',
            'medio_contacto' => 'required|string|max:50',
            'detalle_contacto' => 'nullable|string',
            'acuerdo' => 'nullable|string',
            'idUsuario' => 'required|exists:users,id',
        ]);

        // Crear un nuevo registro
        $seguimiento = MorosoSeguimiento::create($validatedData);

        return response()->json($seguimiento, 201);
    }

    // Mostrar un seguimiento específico
    public function show($id)
    {
        $seguimiento = MorosoSeguimiento::findOrFail($id);
        return response()->json($seguimiento);
    }

    // Actualizar un seguimiento existente en la base de datos
    public function update(Request $request, $id)
    {
        // Validaciones
        $validatedData = $request->validate([
            'idMoroso' => 'sometimes|required|exists:morosos,id',
            'fecha_contacto' => 'sometimes|required|date',
            'medio_contacto' => 'sometimes|required|string|max:50',
            'detalle_contacto' => 'nullable|string',
            'acuerdo' => 'nullable|string',
            'idUsuario' => 'sometimes|required|exists:users,id',
        ]);

        // Buscar y actualizar el registro
        $seguimiento = MorosoSeguimiento::findOrFail($id);
        $seguimiento->update($validatedData);

        return response()->json($seguimiento, 200);
    }

    // Eliminar un seguimiento específico de la base de datos
    public function destroy($id)
    {
        $seguimiento = MorosoSeguimiento::findOrFail($id);
        $seguimiento->delete();

        return response()->json(null, 204);
    }
}
