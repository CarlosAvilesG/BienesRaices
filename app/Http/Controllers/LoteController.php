<?php

namespace App\Http\Controllers;

use App\Repositories\LoteRepositoryInterface;
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

        return view('sistema.lotes.index', compact('lotes'));
      //  return response()->json($lotes);
    }

    public function store(StoreLoteRequest $request)
    {
        $lote = $this->loteRepo->store($request->validated());

        return view('sistema.lotes.show', compact('lote')).with('success', 'Lote creado con exito!');

    }

    public function create()
    {
        return view('sistema.lotes.form');
    }

    public function edit($id)
    {
        $lote = $this->loteRepo->show($id);

        return view('sistema.lotes.form', compact('lote'));
    }

    public function show($id)
    {
        $lote = $this->loteRepo->show($id);

        return view('sistema.lotes.show', compact('lote'));

        //return response()->json($lote);
    }

    public function update(UpdateLoteRequest $request, $id)
    {
        $lote = $this->loteRepo->update($request->validated(), $id);

        return view('sistema.lotes.show', compact('lote')).with('success', 'Lote actualizado con exito!');
        //return response()->json($lote);
    }

    public function destroy($id)
    {
        $this->loteRepo->delete($id);

        return redirect()->route('lotes.index')->with('success', 'Lote eliminado con exito!');
        //return response()->json(null, 204);
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


    // public function getLotesPorPredio(Request $request)
    // {
    //     $predioId = $request->get('predio_id');

    //     // Obtener los lotes asociados al predio seleccionado
    //      $lotes = $this->loteRepo->;

    //     $lotes = Lote::where('idPredio', $predioId)->get();

    //     if ($lotes->isEmpty()) {
    //         return '<div class="alert alert-warning">No hay lotes disponibles para este predio.</div>';
    //     }

    //     // Retornar la vista parcial con los lotes
    //     return view('sistema.lotes.partials.lotes_table', compact('lotes'))->render();
    // }

}
