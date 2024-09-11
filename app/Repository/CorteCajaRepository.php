<?php

namespace App\Repositories;

use App\Models\CorteCaja;

class CorteCajaRepository implements CorteCajaRepositoryInterface
{
    public function getAll()
    {
        return CorteCaja::all();
    }

    public function findById($id)
    {
        return CorteCaja::findOrFail($id);
    }

    public function create(array $data)
    {
        return CorteCaja::create($data);
    }

    public function update($id, array $data)
    {
        $corte = CorteCaja::findOrFail($id);
        $corte->update($data);

        return $corte;
    }

    public function delete($id)
    {
        $corte = CorteCaja::findOrFail($id);
        $corte->delete();
    }
}
