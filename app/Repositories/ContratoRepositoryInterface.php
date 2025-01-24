<?php

namespace App\Repositories;

interface ContratoRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function show($id); // regresa un json con el contrato y el cliente
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);

    // 4. Métodos auxiliares
    public function getContratosByCliente($idCliente);
    public function getContratosByLote($idLote);
}
