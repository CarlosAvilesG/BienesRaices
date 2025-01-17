<?php

namespace App\Repositories;

interface PagoLoteRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function store(array $data);
    public function update(array $data, $id);
    public function delete($id);
}
