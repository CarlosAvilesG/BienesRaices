<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Egreso;

class EgresoController extends Controller
{
     // Mostrar una lista de todos los egresos
     public function index()
     {
         $egresos = Egreso::all();
         return response()->json($egresos);
     }

     // Almacenar un nuevo egreso en la base de datos
     public function store(Request $request)
     {
         // Validaciones
         $validated = $request->validate([
             'idConcepto' => 'required|exists:concepto_egreso,idConcepto',
             'descripcion' => 'nullable|string|max:300',
             'monto' => 'required|numeric|min:0',
             'idUsuarioRecibe' => 'required|exists:users,id',
             'fecha' => 'required|date',
             'hora' => 'required|string|max:8',
             'idUsuario' => 'required|exists:users,id',
             'supervisado' => 'boolean',
             'idUsuSupervisa' => 'nullable|exists:users,id',
             'cancelado' => 'boolean',
             'idUsuCancela' => 'nullable|exists:users,id',
             'pendienteDevolucion' => 'boolean',
             'montoDevuelto' => 'nullable|numeric|min:0',
             'fechaDevolucion' => 'nullable|date',
             'idUsuarioDevuelve' => 'nullable|exists:users,id',
         ]);

         // Crear el egreso
         $egreso = Egreso::create($validated);

         return response()->json($egreso, 201);
     }

     // Mostrar un egreso específico
     public function show($id)
     {
         $egreso = Egreso::findOrFail($id);
         return response()->json($egreso);
     }

     // Actualizar un egreso existente
     public function update(Request $request, $id)
     {
         // Validaciones
         $validated = $request->validate([
             'idConcepto' => 'required|exists:concepto_egreso,idConcepto',
             'descripcion' => 'nullable|string|max:300',
             'monto' => 'required|numeric|min:0',
             'idUsuarioRecibe' => 'required|exists:users,id',
             'fecha' => 'required|date',
             'hora' => 'required|string|max:8',
             'idUsuario' => 'required|exists:users,id',
             'supervisado' => 'boolean',
             'idUsuSupervisa' => 'nullable|exists:users,id',
             'cancelado' => 'boolean',
             'idUsuCancela' => 'nullable|exists:users,id',
             'pendienteDevolucion' => 'boolean',
             'montoDevuelto' => 'nullable|numeric|min:0',
             'fechaDevolucion' => 'nullable|date',
             'idUsuarioDevuelve' => 'nullable|exists:users,id',
         ]);

         // Encontrar y actualizar el egreso
         $egreso = Egreso::findOrFail($id);
         $egreso->update($validated);

         return response()->json($egreso);
     }

     // Eliminar un egreso
     public function destroy($id)
     {
         $egreso = Egreso::findOrFail($id);
         $egreso->delete();

         return response()->json(null, 204);
     }
}
