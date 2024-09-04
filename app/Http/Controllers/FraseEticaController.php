<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FraseEtica;

class FraseEticaController extends Controller
{
    // Mostrar una lista de todas las frases éticas
    public function index()
    {
        $frases = FraseEtica::all();
        return response()->json($frases);
    }

    // Almacenar una nueva frase ética en la base de datos
    public function store(Request $request)
    {
        // Validaciones
        $validated = $request->validate([
            'frase' => 'required|string',
            'autor' => 'nullable|string|max:100',
        ]);

        // Crear la frase ética
        $frase = FraseEtica::create($validated);

        return response()->json($frase, 201);
    }

    // Mostrar una frase ética específica
    public function show($id)
    {
        $frase = FraseEtica::findOrFail($id);
        return response()->json($frase);
    }

    // Actualizar una frase ética existente
    public function update(Request $request, $id)
    {
        // Validaciones
        $validated = $request->validate([
            'frase' => 'required|string',
            'autor' => 'nullable|string|max:100',
        ]);

        // Encontrar y actualizar la frase ética
        $frase = FraseEtica::findOrFail($id);
        $frase->update($validated);

        return response()->json($frase);
    }

    // Eliminar una frase ética
    public function destroy($id)
    {
        $frase = FraseEtica::findOrFail($id);
        $frase->delete();

        return response()->json(null, 204);
    }

    // Obtener una frase ética de manera aleatoria
    public function random()
    {
        $frase = FraseEtica::inRandomOrder()->first();
        return response()->json($frase);
    }
}
