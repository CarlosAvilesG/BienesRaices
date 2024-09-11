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
}
