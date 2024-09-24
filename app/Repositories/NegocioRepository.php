<?php

namespace App\Repositories;

use App\Models\Negocio;
use App\Repositories\NegocioRepositoryInterface;

class NegocioRepository implements NegocioRepositoryInterface
{
    public function getAll()
    {
        return Negocio::all();
    }

    public function findById($id)
    {
        return Negocio::findOrFail($id);
    }

    public function create(array $data)
    {
        return Negocio::create($data);
    }

    public function update(array $data, $id)
    {
        $negocio = Negocio::findOrFail($id);
        $negocio->update($data);

        return $negocio;
    }

    public function delete($id)
    {
        $negocio = Negocio::findOrFail($id);
        return $negocio->delete();
    }
}
