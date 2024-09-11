<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\ConceptoEgreso;

class ConceptoEgresoController extends Controller
{
     // Mostrar una lista de todos los conceptos de egreso
     public function index()
     {
         $conceptos = ConceptoEgreso::all();
         return response()->json($conceptos);
     }

     // Almacenar un nuevo concepto de egreso en la base de datos
     public function store(Request $request)
     {
         // Validaciones
         $validated = $request->validate([
             'descripcion' => 'required|string|max:50',
             'gastoCorriente' => 'boolean',
             'requiereDevolucion' => 'boolean',
         ]);

         // Crear el concepto de egreso
         $concepto = ConceptoEgreso::create($validated);

         return response()->json($concepto, 201);
     }

     // Mostrar un concepto de egreso específico
     public function show($id)
     {
         $concepto = ConceptoEgreso::findOrFail($id);
         return response()->json($concepto);
     }

     // Actualizar un concepto de egreso existente
     public function update(Request $request, $id)
     {
         // Validaciones
         $validated = $request->validate([
             'descripcion' => 'required|string|max:50',
             'gastoCorriente' => 'boolean',
             'requiereDevolucion' => 'boolean',
         ]);

         // Encontrar y actualizar el concepto de egreso
         $concepto = ConceptoEgreso::findOrFail($id);
         $concepto->update($validated);

         return response()->json($concepto);
     }

     // Eliminar un concepto de egreso
     public function destroy($id)
     {
         $concepto = ConceptoEgreso::findOrFail($id);
         $concepto->delete();

         return response()->json(null, 204);
     }
}
