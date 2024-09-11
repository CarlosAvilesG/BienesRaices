<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bitacora;

class BitacoraController extends Controller
{
    // Mostrar una lista de todos los registros de la bitácora
    public function index()
    {
        $bitacora = Bitacora::all();
        return response()->json($bitacora);
    }

    // Almacenar un nuevo registro en la bitácora
    public function store(Request $request)
    {
        // Validaciones
        $validated = $request->validate([
            'fecha' => 'required|date',
            'usuario' => 'required|exists:users,id',
            'tabla' => 'required|string|max:50',
            'tipoOperacion' => 'required|string|max:20',
            'campoLlave' => 'required|string|max:50',
            'descripcion' => 'nullable|string',
            'ip' => 'nullable|string|max:45',
            'user_agent' => 'nullable|string',
        ]);

        // Crear el registro de la bitácora
        $bitacora = Bitacora::create($validated);

        return response()->json($bitacora, 201);
    }

    // Mostrar un registro específico de la bitácora
    public function show($id)
    {
        $bitacora = Bitacora::findOrFail($id);
        return response()->json($bitacora);
    }

    // Actualizar un registro existente de la bitácora
    public function update(Request $request, $id)
    {
        // Validaciones
        $validated = $request->validate([
            'fecha' => 'required|date',
            'usuario' => 'required|exists:users,id',
            'tabla' => 'required|string|max:50',
            'tipoOperacion' => 'required|string|max:20',
            'campoLlave' => 'required|string|max:50',
            'descripcion' => 'nullable|string',
            'ip' => 'nullable|string|max:45',
            'user_agent' => 'nullable|string',
        ]);

        // Encontrar y actualizar el registro de la bitácora
        $bitacora = Bitacora::findOrFail($id);
        $bitacora->update($validated);

        return response()->json($bitacora);
    }

    // Eliminar un registro de la bitácora
    public function destroy($id)
    {
        $bitacora = Bitacora::findOrFail($id);
        $bitacora->delete();

        return response()->json(null, 204);
    }
}
