<?php

namespace App\Repositories;

use App\Models\Contrato;

class ContratoRepository implements ContratoRepositoryInterface
{
    public function getAll()
    {
        return Contrato::all();
    }

    public function findById($id)
    {
        return Contrato::findOrFail($id);
    }
    public function show($id)
    {
        $contrato = Contrato::with('cliente')->findOrFail($id);

        return response()->json([
            'contrato' => $contrato,
            'cliente' => $contrato->cliente,
        ]);
    }

    public function create(array $data)
    {
        return Contrato::create($data);
    }

    public function update($id, array $data)
    {
        $contrato = Contrato::findOrFail($id);
        $contrato->update($data);

        return $contrato;
    }

    public function delete($id)
    {
        $contrato = Contrato::findOrFail($id);
        $contrato->delete();
    }

    // 4. Métodos auxiliares
    // obtener contratos por cliente
    public function getContratosByCliente($idCliente)
    {
        return Contrato::where('idCliente', $idCliente)->orderBy('fechaCelebracion', 'asc')->get();
    }
    // obtener contratos por lote
    public function getContratosByLote($idLote)
    {
        return Contrato::where('idLote', $idLote)->orderBy('estatus', 'asc')->get();
    }
}
