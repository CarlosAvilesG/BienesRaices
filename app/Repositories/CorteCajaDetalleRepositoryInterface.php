<?php

namespace App\Repositories;

interface CorteCajaDetalleRepositoryInterface
{
    public function getAll();
    public function create(array $data);
    public function findById($id);
    public function update(array $data, $id);
    public function delete($id);
}
