<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PagoLote;

class PagoLoteController extends Controller
{
   // Mostrar una lista de todos los pagos de lotes
   public function index()
   {
       $pagos = PagoLote::all();
       return response()->json($pagos);
   }

   // Almacenar un nuevo pago en la base de datos
   public function store(Request $request)
   {
       // Validaciones
       $validated = $request->validate([
           'idPredio' => 'required|exists:predio,idPredio',
           'idLote' => 'required|exists:lotes,idLote',
           'folio' => 'nullable|integer',
           'idContrato' => 'nullable|integer',
           'idCliente' => 'required|exists:clientes,idCliente',
           'tipoPago' => 'required|string|max:50',
           'referenciaBancaria' => 'nullable|string|max:100',
           'monto' => 'required|numeric|min:0',
           'pagoNumero' => 'nullable|integer',
           'deudaAnterior' => 'nullable|numeric|min:0',
           'fechaPago' => 'required|date',
           'horaPago' => 'required|string|max:8',
           'idUsuario' => 'required|exists:users,id',
           'observacion' => 'nullable|string',
           'cancelar' => 'boolean',
           'idUsuarioCancela' => 'nullable|exists:users,id',
           'pagoValidado' => 'boolean',
           'idUsuarioValidaPago' => 'nullable|exists:users,id',
           'historico' => 'boolean',
       ]);

       // Crear el pago
       $pagoLote = PagoLote::create($validated);

       return response()->json($pagoLote, 201);
   }

   // Mostrar un pago específico
   public function show($id)
   {
       $pagoLote = PagoLote::findOrFail($id);
       return response()->json($pagoLote);
   }

   // Actualizar un pago existente
   public function update(Request $request, $id)
   {
       // Validaciones
       $validated = $request->validate([
           'idPredio' => 'required|exists:predio,idPredio',
           'idLote' => 'required|exists:lotes,idLote',
           'folio' => 'nullable|integer',
           'idContrato' => 'nullable|integer',
           'idCliente' => 'required|exists:clientes,idCliente',
           'tipoPago' => 'required|string|max:50',
           'referenciaBancaria' => 'nullable|string|max:100',
           'monto' => 'required|numeric|min:0',
           'pagoNumero' => 'nullable|integer',
           'deudaAnterior' => 'nullable|numeric|min:0',
           'fechaPago' => 'required|date',
           'horaPago' => 'required|string|max:8',
           'idUsuario' => 'required|exists:users,id',
           'observacion' => 'nullable|string',
           'cancelar' => 'boolean',
           'idUsuarioCancela' => 'nullable|exists:users,id',
           'pagoValidado' => 'boolean',
           'idUsuarioValidaPago' => 'nullable|exists:users,id',
           'historico' => 'boolean',
       ]);

       // Encontrar y actualizar el pago
       $pagoLote = PagoLote::findOrFail($id);
       $pagoLote->update($validated);

       return response()->json($pagoLote);
   }

   // Eliminar un pago
   public function destroy($id)
   {
       $pagoLote = PagoLote::findOrFail($id);
       $pagoLote->delete();

       return response()->json(null, 204);
   }
}
