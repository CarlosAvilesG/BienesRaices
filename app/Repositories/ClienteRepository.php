<?php

namespace App\Repositories;

use App\Models\Cliente;

class ClienteRepository implements ClienteRepositoryInterface
{
    public function getAll()
    {
        return Cliente::all();
    }

    // ver todos los clientes incluyendo los eliminados
    public function getAllWithTrashed()
    {
        return Cliente::withTrashed()->get();
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
    public function restore($id)
    {
        $cliente = Cliente::withTrashed()->findOrFail($id);
        $cliente->restore();
        return true;
    }
}
