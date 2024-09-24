<?php

namespace App\Repositories;

use App\Models\MorosoSeguimiento;
use App\Repositories\MorosoSeguimientoRepositoryInterface;

class MorosoSeguimientoRepository implements MorosoSeguimientoRepositoryInterface
{
    public function getAll()
    {
        return MorosoSeguimiento::all();
    }

    public function findById($id)
    {
        return MorosoSeguimiento::findOrFail($id);
    }

    public function create(array $data)
    {
        return MorosoSeguimiento::create($data);
    }

    public function update(array $data, $id)
    {
        $seguimiento = MorosoSeguimiento::findOrFail($id);
        $seguimiento->update($data);

        return $seguimiento;
    }

    public function delete($id)
    {
        $seguimiento = MorosoSeguimiento::findOrFail($id);
        return $seguimiento->delete();
    }
}
