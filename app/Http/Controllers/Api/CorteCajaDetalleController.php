<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CorteCajaDetalle;

class CorteCajaDetalleController extends Controller
{
  // Mostrar una lista de todos los detalles de corte de caja
  public function index()
  {
      $detalles = CorteCajaDetalle::all();
      return response()->json($detalles);
  }

  // Almacenar un nuevo detalle de corte de caja en la base de datos
  public function store(Request $request)
  {
      // Validaciones
      $validated = $request->validate([
          'idCorteCaja' => 'required|exists:corte_caja,idCorteCaja',
          'idPagoLote' => 'nullable|exists:pagos_lote,id',
          'idEgreso' => 'nullable|exists:egresos,idEgresos',
          'monto' => 'required|numeric|min:0',
          'tipoMovimiento' => 'required|string|max:20',
      ]);

      // Crear el detalle de corte de caja
      $detalle = CorteCajaDetalle::create($validated);

      return response()->json($detalle, 201);
  }

  // Mostrar un detalle de corte de caja específico
  public function show($id)
  {
      $detalle = CorteCajaDetalle::findOrFail($id);
      return response()->json($detalle);
  }

  // Actualizar un detalle de corte de caja existente
  public function update(Request $request, $id)
  {
      // Validaciones
      $validated = $request->validate([
          'idCorteCaja' => 'required|exists:corte_caja,idCorteCaja',
          'idPagoLote' => 'nullable|exists:pagos_lote,id',
          'idEgreso' => 'nullable|exists:egresos,idEgresos',
          'monto' => 'required|numeric|min:0',
          'tipoMovimiento' => 'required|string|max:20',
      ]);

      // Encontrar y actualizar el detalle de corte de caja
      $detalle = CorteCajaDetalle::findOrFail($id);
      $detalle->update($validated);

      return response()->json($detalle);
  }

  // Eliminar un detalle de corte de caja
  public function destroy($id)
  {
      $detalle = CorteCajaDetalle::findOrFail($id);
      $detalle->delete();

      return response()->json(null, 204);
  }


}
