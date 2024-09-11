<?php

namespace App\Repositories;

use App\Models\ClienteReferencia;
use Illuminate\Support\Collection;

interface ClienteReferenciaRepositoryInterface
{
    /**
     * Obtener todas las referencias de clientes.
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Encontrar una referencia de cliente por ID.
     *
     * @param int $id
     * @return ClienteReferencia|null
     */
    public function findById(int $id): ?ClienteReferencia;

    /**
     * Crear una nueva referencia de cliente.
     *
     * @param array $data
     * @return ClienteReferencia
     */
    public function create(array $data): ClienteReferencia;

    /**
     * Actualizar una referencia de cliente existente.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool;

    /**
     * Eliminar una referencia de cliente por ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
