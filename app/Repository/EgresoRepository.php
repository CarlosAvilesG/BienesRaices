<?php

namespace App\Repository;

use App\Models\Egreso;

class EgresoRepository implements EgresoRepositoryInterface
{
    public function getAll()
    {
        return Egreso::all();
    }

    public function store(array $data)
    {
        return Egreso::create($data);
    }

    public function show($id)
    {
        return Egreso::findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $egreso = Egreso::findOrFail($id);
        $egreso->update($data);
        return $egreso;
    }

    public function delete($id)
    {
        return Egreso::destroy($id);
    }
}
