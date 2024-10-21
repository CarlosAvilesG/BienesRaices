<?php

namespace App\Repositories;

use App\Models\Bitacora;


class BitacoraRepository implements BitacoraRepositoryInterface
{
    // Obtener todos los registros de la bitácora
    public function getAll()
    {
        return Bitacora::all();
    }

    // Obtener un registro específico por su ID
    public function findById($id)
    {
        return Bitacora::findOrFail($id);
    }

    // Crear un nuevo registro en la bitácora
    public function create(array $data)
    {
        return Bitacora::create($data);
    }

    // Actualizar un registro de la bitácora
    public function update($id, array $data)
    {
        $bitacora = Bitacora::findOrFail($id);
        $bitacora->update($data);

        return $bitacora;
    }

    // Eliminar un registro de la bitácora
    public function delete($id)
    {
        $bitacora = Bitacora::findOrFail($id);
        $bitacora->delete();
    }
}
