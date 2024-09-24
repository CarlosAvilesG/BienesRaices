<?php

namespace App\Repositories;

use App\Models\Cliente;

class ClienteRepository implements ClienteRepositoryInterface
{
    public function getAll()
    {
        return Cliente::all();
    }

    public function store(array $data)
    {
        return Cliente::create($data);
    }

    public function find($id)
    {
        return Cliente::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->update($data);
        return $cliente;
    }

    public function delete($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return true;
    }
}
