<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CorteCaja;

class CorteCajaController extends Controller
{
    // Mostrar una lista de todos los cortes de caja
    public function index()
    {
        $cortes = CorteCaja::all();
        return response()->json($cortes);
    }

    // Almacenar un nuevo corte de caja en la base de datos
    public function store(Request $request)
    {
        // Validaciones
        $validated = $request->validate([
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date',
            'totalIngresosFisicos' => 'required|numeric|min:0',
            'totalIngresosBancarios' => 'required|numeric|min:0',
            'totalEgresos' => 'required|numeric|min:0',
            'totalPrestamos' => 'required|numeric|min:0',
            'idUsuario' => 'required|exists:users,id',
        ]);

        // Crear el corte de caja
        $corte = CorteCaja::create($validated);

        return response()->json($corte, 201);
    }

    // Mostrar un corte de caja específico
    public function show($id)
    {
        $corte = CorteCaja::findOrFail($id);
        return response()->json($corte);
    }

    // Actualizar un corte de caja existente
    public function update(Request $request, $id)
    {
        // Validaciones
        $validated = $request->validate([
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date',
            'totalIngresosFisicos' => 'required|numeric|min:0',
            'totalIngresosBancarios' => 'required|numeric|min:0',
            'totalEgresos' => 'required|numeric|min:0',
            'totalPrestamos' => 'required|numeric|min:0',
            'idUsuario' => 'required|exists:users,id',
        ]);

        // Encontrar y actualizar el corte de caja
        $corte = CorteCaja::findOrFail($id);
        $corte->update($validated);

        return response()->json($corte);
    }

    // Eliminar un corte de caja
    public function destroy($id)
    {
        $corte = CorteCaja::findOrFail($id);
        $corte->delete();

        return response()->json(null, 204);
    }
}
