<?php

namespace App\Http\Controllers;

use App\Repository\LoteRepositoryInterface;
use App\Http\Requests\StoreLoteRequest;
use App\Http\Requests\UpdateLoteRequest;
use Illuminate\Http\Request;

class LoteController extends Controller
{
    protected $loteRepo;

    public function __construct(LoteRepositoryInterface $loteRepo)
    {
        $this->loteRepo = $loteRepo;
    }

    public function index()
    {
        $lotes = $this->loteRepo->getAll();
        return response()->json($lotes);
    }

    public function store(StoreLoteRequest $request)
    {
        $lote = $this->loteRepo->store($request->validated());
        return response()->json($lote, 201);
    }

    public function show($id)
    {
        $lote = $this->loteRepo->show($id);
        return response()->json($lote);
    }

    public function update(UpdateLoteRequest $request, $id)
    {
        $lote = $this->loteRepo->update($request->validated(), $id);
        return response()->json($lote);
    }

    public function destroy($id)
    {
        $this->loteRepo->delete($id);
        return response()->json(null, 204);
    }

    public function addFoto(Request $request, $idLote)
    {
        $request->validate([
            'foto_url' => 'required|string|max:255',
        ]);

        $loteFoto = $this->loteRepo->addFoto($idLote, $request->validated());
        return response()->json($loteFoto, 201);
    }

    public function getFotos($idLote)
    {
        $fotos = $this->loteRepo->getFotos($idLote);
        return response()->json($fotos);
    }

    public function deleteFoto($idLote, $idFoto)
    {
        $this->loteRepo->deleteFoto($idLote, $idFoto);
        return response()->json(null, 204);
    }
}
