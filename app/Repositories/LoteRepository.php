<?php

namespace App\Repositories;

use App\Models\Lote;
use App\Models\LoteFoto;

class LoteRepository implements LoteRepositoryInterface
{
    public function getAll()
    {
        return Lote::all();
    }

    public function store(array $data)
    {
        return Lote::create($data);
    }

    public function show($id)
    {
        return Lote::findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $lote = Lote::findOrFail($id);
        $lote->update($data);
        return $lote;
    }

    public function delete($id)
    {
        return Lote::destroy($id);
    }

    public function addFoto($idLote, array $data)
    {
        $lote = Lote::findOrFail($idLote);
        $foto = new LoteFoto([
            'idLote' => $lote->idLote,
            'foto_url' => $data['foto_url'],
        ]);
        $foto->save();
        return $foto;
    }

    public function getFotos($idLote)
    {
        $lote = Lote::findOrFail($idLote);
        return $lote->fotos;
    }

    public function deleteFoto($idLote, $idFoto)
    {
        $lote = Lote::findOrFail($idLote);
        $foto = LoteFoto::where('idLote', $lote->idLote)->where('id', $idFoto)->firstOrFail();
        $foto->delete();
        return true;
    }

    public function getLotesByPredio($idPredio)
    {
        return Lote::where('idPredio', $idPredio)->get();
    }

    // obtener lote por idContrato
    public function getLoteByContrato($idContrato)
    {
        return Lote::where('idContrato', $idContrato)->get();// Esto devuelve una colección
    }

    public function getAvailableLotes()
    {
       return Lote::whereNull('idContrato')
       ->where('inhabilitado', 0)
       ->get();
    }


}
