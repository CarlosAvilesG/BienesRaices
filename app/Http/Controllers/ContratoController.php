<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contrato;

class ContratoController extends Controller
{
     // Mostrar una lista de todos los contratos
     public function index()
     {
         $contratos = Contrato::all();
         return response()->json($contratos);
     }

     // Almacenar un nuevo contrato en la base de datos
     public function store(Request $request)
     {
         // Validaciones
         $validated = $request->validate([
             'idCliente' => 'required|exists:clientes,idCliente',
             'idLote' => 'required|exists:lotes,idLote',
             'NoContrato' => 'required|string|max:50',
             'NoConvenio' => 'nullable|string|max:10',
             'NoLetras' => 'nullable|integer|min:0',
             'PrecioPredio' => 'required|numeric|min:0',
             'InteresMoroso' => 'nullable|numeric|min:0|max:99.9',
             'FechaCelebracion' => 'required|date',
             'HoraCelebracion' => 'required|string|max:8',
             'FechaTerminoLetras' => 'nullable|date',
             'ConvenioTemporalidadPago' => 'nullable|string|max:50',
             'ConvenioViaPago' => 'nullable|string|max:50',
             'FechaRegistro' => 'required|date',
             'HoraRegistro' => 'required|string|max:8',
             'idUsuario' => 'required|exists:users,id',
             'observacion' => 'nullable|string',
             'cancelado' => 'boolean',
             'idUsuCancela' => 'nullable|exists:users,id',
             'CanceladoObservacion' => 'nullable|string',
         ]);

         // Crear el contrato
         $contrato = Contrato::create($validated);

         return response()->json($contrato, 201);
     }

     // Mostrar un contrato específico
     public function show($id)
     {
         $contrato = Contrato::findOrFail($id);
         return response()->json($contrato);
     }

     // Actualizar un contrato existente
     public function update(Request $request, $id)
     {
         // Validaciones
         $validated = $request->validate([
             'idCliente' => 'required|exists:clientes,idCliente',
             'idLote' => 'required|exists:lotes,idLote',
             'NoContrato' => 'required|string|max:50',
             'NoConvenio' => 'nullable|string|max:10',
             'NoLetras' => 'nullable|integer|min:0',
             'PrecioPredio' => 'required|numeric|min:0',
             'InteresMoroso' => 'nullable|numeric|min:0|max:99.9',
             'FechaCelebracion' => 'required|date',
             'HoraCelebracion' => 'required|string|max:8',
             'FechaTerminoLetras' => 'nullable|date',
             'ConvenioTemporalidadPago' => 'nullable|string|max:50',
             'ConvenioViaPago' => 'nullable|string|max:50',
             'FechaRegistro' => 'required|date',
             'HoraRegistro' => 'required|string|max:8',
             'idUsuario' => 'required|exists:users,id',
             'observacion' => 'nullable|string',
             'cancelado' => 'boolean',
             'idUsuCancela' => 'nullable|exists:users,id',
             'CanceladoObservacion' => 'nullable|string',
         ]);

         // Encontrar y actualizar el contrato
         $contrato = Contrato::findOrFail($id);
         $contrato->update($validated);

         return response()->json($contrato);
     }

     // Eliminar un contrato
     public function destroy($id)
     {
         $contrato = Contrato::findOrFail($id);
         $contrato->delete();

         return response()->json(null, 204);
     }
}
