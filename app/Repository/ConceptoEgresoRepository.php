<?php

namespace App\Repositories;

use App\Models\ConceptoEgreso;

class ConceptoEgresoRepository implements ConceptoEgresoRepositoryInterface
{
    // Obtener todos los conceptos de egreso
    public function getAll()
    {
        return ConceptoEgreso::all();
    }

    // Obtener un concepto específico por su ID
    public function findById($id)
    {
        return ConceptoEgreso::findOrFail($id);
    }

    // Crear un nuevo concepto de egreso
    public function create(array $data)
    {
        return ConceptoEgreso::create($data);
    }

    // Actualizar un concepto de egreso
    public function update($id, array $data)
    {
        $concepto = ConceptoEgreso::findOrFail($id);
        $concepto->update($data);

        return $concepto;
    }

    // Eliminar un concepto de egreso
    public function delete($id)
    {
        $concepto = ConceptoEgreso::findOrFail($id);
        $concepto->delete();
    }
}
