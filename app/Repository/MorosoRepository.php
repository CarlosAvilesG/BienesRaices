<?php

namespace App\Repository;

use App\Models\Moroso;
use App\Repository\MorosoRepositoryInterface;

class MorosoRepository implements MorosoRepositoryInterface
{
    public function getAll()
    {
        return Moroso::all();
    }

    public function findById($id)
    {
        return Moroso::findOrFail($id);
    }

    public function create(array $data)
    {
        return Moroso::create($data);
    }

    public function update(array $data, $id)
    {
        $moroso = Moroso::findOrFail($id);
        $moroso->update($data);

        return $moroso;
    }

    public function delete($id)
    {
        $moroso = Moroso::findOrFail($id);
        return $moroso->delete();
    }
}
