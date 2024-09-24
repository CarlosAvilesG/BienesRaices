<?php

namespace App\Repositories;

use App\Models\CorteCajaDetalle;

class CorteCajaDetalleRepository implements CorteCajaDetalleRepositoryInterface
{
    public function getAll()
    {
        return CorteCajaDetalle::all();
    }

    public function store(array $data)
    {
        return CorteCajaDetalle::create($data);
    }

    public function show($id)
    {
        return CorteCajaDetalle::findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $detalle = CorteCajaDetalle::findOrFail($id);
        $detalle->update($data);
        return $detalle;
    }

    public function delete($id)
    {
        return CorteCajaDetalle::destroy($id);
    }
}
