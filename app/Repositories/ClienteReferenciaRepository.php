<?php

namespace App\Repositories;

use App\Models\ClienteReferencia;
use Illuminate\Support\Collection;

class ClienteReferenciaRepository implements ClienteReferenciaRepositoryInterface
{
    /**
     * Obtener todas las referencias de clientes.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return ClienteReferencia::all();
    }

    /**
     * Encontrar una referencia de cliente por ID.
     *
     * @param int $id
     * @return ClienteReferencia|null
     */
    public function findById(int $id): ?ClienteReferencia
    {
        return ClienteReferencia::find($id);
    }

    /**
     * Crear una nueva referencia de cliente.
     *
     * @param array $data
     * @return ClienteReferencia
     */
    public function create(array $data): ClienteReferencia
    {
        return ClienteReferencia::create($data);
    }

    /**
     * Actualizar una referencia de cliente existente.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $clienteReferencia = ClienteReferencia::find($id);

        if ($clienteReferencia) {
            return $clienteReferencia->update($data);
        }

        return false;
    }

    /**
     * Eliminar una referencia de cliente por ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $clienteReferencia = ClienteReferencia::find($id);

        if ($clienteReferencia) {
            return $clienteReferencia->delete();
        }

        return false;
    }
}
