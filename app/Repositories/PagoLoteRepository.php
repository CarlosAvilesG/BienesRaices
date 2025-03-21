<?php

namespace App\Repositories;

use App\Models\PagoLote;
use App\Repositories\PagoLoteRepositoryInterface;

class PagoLoteRepository implements PagoLoteRepositoryInterface
{
    public function getAll()
    {
        return PagoLote::all();
    }

    public function findById($id)
    {
        return PagoLote::findOrFail($id);
    }

    public function store(array $data)
    {
        return PagoLote::create($data);
    }

    public function update(array $data, $id)
    {
        $pagoLote = PagoLote::findOrFail($id);
        $pagoLote->update($data);

        return $pagoLote;
    }

    public function delete($id)
    {
        $pagoLote = PagoLote::findOrFail($id);
        return $pagoLote->delete();
    }
    // 4. Métodos auxiliares
    //obter pagos por idcontrato
    public function getPagosByContrato($idContrato, $perPage = 10)
    {
        return PagoLote::where('idContrato', $idContrato)->orderBy('fechaPago', 'asc')->paginate($perPage);
    }

    //obtener pagos por idusuario
    public function getPagosByUser($idUsuario, $fechaInicio, $fechaFin)
    {
        return PagoLote::where('idUsuario', $idUsuario)
                        ->whereBetween('fechaPago', [$fechaInicio, $fechaFin])
                        ->get()
                        ->sortBy('fechaPago');
    }
    // obtener el primer registro de idusuario
    public function getFirstPagoByUser($idUsuario)
    {
        return PagoLote::where('idUsuario', $idUsuario)
        ->orderBy('fechaPago', 'asc')
        ->orderBy('horaPago', 'asc') // Para asegurar precisión
        ->first();
    }
}
