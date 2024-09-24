<?php

namespace App\Repositories;

interface PredioRepositoryInterface
{
    public function getAllPredios();

    public function findPredioById($id);

    public function createPredio(array $data);

    public function updatePredio($id, array $data);

    public function deletePredio($id);
}
