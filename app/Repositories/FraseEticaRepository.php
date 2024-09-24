<?php

namespace App\Repositories;

use App\Models\FraseEtica;

class FraseEticaRepository implements FraseEticaRepositoryInterface
{
    public function getAll()
    {
        return FraseEtica::all();
    }

    public function store(array $data)
    {
        return FraseEtica::create($data);
    }

    public function show($id)
    {
        return FraseEtica::findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $frase = FraseEtica::findOrFail($id);
        $frase->update($data);
        return $frase;
    }

    public function delete($id)
    {
        return FraseEtica::destroy($id);
    }

    public function getRandom()
    {
        return FraseEtica::inRandomOrder()->first();
    }
}
