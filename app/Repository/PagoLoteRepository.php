<?php

namespace App\Repository;

use App\Models\PagoLote;
use App\Repository\PagoLoteRepositoryInterface;

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

    public function create(array $data)
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
}
