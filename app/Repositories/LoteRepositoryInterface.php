<?php

namespace App\Repositories;

interface LoteRepositoryInterface
{
    public function getAll();
    public function store(array $data);
    public function show($id);
    public function update(array $data, $id);
    public function delete($id);

    public function addFoto($idLote, array $data);
    public function getFotos($idLote);
    public function deleteFoto($idLote, $idFoto);

    public function getLotesByPredio($idPredio);
    public function getLoteByContrato($idContrato);
    public function getAvailableLotes();

}
