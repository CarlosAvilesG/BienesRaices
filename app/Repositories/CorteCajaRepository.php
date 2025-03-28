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

    public function getCorteByUser($userId)
    {
        // 🔹 Último corte registrado por este usuario
        return CorteCaja::where('idUsuario', $userId)
                        ->latest('fechaFin')
                        ->first();
    }
    public function getCortesByUser($userId)
    {
        // 🔹 obtener los ultimos 10 cortes de un usuario

        return CorteCaja::where('idUsuario', $userId)
                        ->latest('fechaFin')
                        ->limit(10)
                        ->get();
    }
}
