<?php

namespace App\Repositories;

interface EgresoRepositoryInterface
{
    public function getAll();
    public function store(array $data);
    public function show($id);
    public function update(array $data, $id);
    public function delete($id);
}
