<?php

namespace App\Repositories;

interface PagoLoteRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function store(array $data);
    public function update(array $data, $id);
    public function delete($id);

    // 4. Métodos auxiliares
    public function getPagosByContrato($idContrato);
    public function getPagosByUser($idUsuario, $fechaInicio, $fechaFin);
    public function getFirstPagoByUser($idUsuario);
}
