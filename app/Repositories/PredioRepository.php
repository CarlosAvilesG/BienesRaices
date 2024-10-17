<?php

namespace App\Repositories;

use App\Models\Predio;

class PredioRepository implements PredioRepositoryInterface
{
    public function getAll()
    {
        return Predio::all();
    }

    public function find($id)
    {
        return Predio::findOrFail($id);
    }

    public function createPredio(array $data)
    {
        return Predio::create($data);
    }

    public function updatePredio($id, array $data)
    {
        $predio = Predio::findOrFail($id);
        $predio->update($data);
        return $predio;
    }

    public function deletePredio($id)
    {
        $predio = Predio::findOrFail($id);
        return $predio->delete();
    }
}
