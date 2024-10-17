<?php

namespace App\Repositories;

interface PredioRepositoryInterface
{
    public function getAll();

    public function find($id);

    public function createPredio(array $data);

    public function updatePredio($id, array $data);

    public function deletePredio($id);
}
