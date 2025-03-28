<?php

namespace App\Repositories;

use App\Models\CorteCajaDetalle;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Models\PagoLote;
use App\Models\Egreso;

class CorteCajaDetalleRepository implements CorteCajaDetalleRepositoryInterface
{
    public function getAll()
    {
        return CorteCajaDetalle::all();
    }

    public function create(array $data)
    {
        return CorteCajaDetalle::create($data);
    }

    public function findById($id)
    {
        return CorteCajaDetalle::findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $detalle = CorteCajaDetalle::findOrFail($id);
        $detalle->update($data);
        return $detalle;
    }

    public function delete($id)
    {
        return CorteCajaDetalle::destroy($id);

    }

    /**
     * 🔍 Obtener detalles "preliminares" (sin corte registrado) para un usuario en un rango de fechas.
     */
    public function getPreliminar($idUsuario, $fechaInicio, $fechaFin): Collection
    {
        $fechaInicio = Carbon::parse($fechaInicio)->startOfSecond();
        $fechaFin = Carbon::parse($fechaFin)->endOfSecond();

        $ingresos = PagoLote::with(['cliente', 'lote.predio', 'contrato'])
            ->where('idUsuario', $idUsuario)
            ->whereBetween('fechaPago', [$fechaInicio, $fechaFin])
            ->get()
            ->map(function ($pago) {
                return (object)[
                    'tipoMovimiento' => 'Ingreso',
                    'pagoLote' => $pago,
                    'egreso' => null,
                    'monto' => $pago->monto,
                ];
            });

        $egresos = Egreso::where('idUsuario', $idUsuario)
            ->whereBetween('created_at', [$fechaInicio, $fechaFin])
            ->get()
            ->map(function ($egreso) {
                return (object)[
                    'tipoMovimiento' => 'Egreso',
                    'pagoLote' => null,
                    'egreso' => $egreso,
                    'monto' => $egreso->monto,
                ];
            });

        // 🔀 Combinar ambas colecciones
        return $ingresos->merge($egresos)->sortBy('tipoMovimiento')->values();
    }
}
