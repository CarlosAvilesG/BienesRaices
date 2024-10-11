<?php

namespace App\Http\Controllers;

use App\Repositories\LoteRepositoryInterface;
use App\Repositories\PredioRepositoryInterface; // Inyecta el repo de Predios si es necesario
use App\Http\Requests\StoreLoteRequest;
use App\Http\Requests\UpdateLoteRequest;
use Illuminate\Http\Request;

class LoteController extends Controller
{
    protected $loteRepo;
    protected $predioRepo;

    public function __construct(LoteRepositoryInterface $loteRepo, PredioRepositoryInterface $predioRepo)
    {
        $this->loteRepo = $loteRepo;
        $this->predioRepo = $predioRepo; // Inyecta el repo de Predios si es necesario
    }

    public function index(Request $request)
    {
        $predios = $this->predioRepo->getAllPredios(); // Obtener todos los predios
        $lotes = $this->loteRepo->getAll();     // Obtener todos los lotes o lotes del predio filtrado

        return view('sistema.lotes.index', compact('lotes', 'predios'));

      //  return response()->json($lotes);
    }

    public function store(StoreLoteRequest $request)
    {
        $lote = $this->loteRepo->store($request->validated());
        $predioId = $request->query('predio_id');

        return redirect()->route('lotes.index', ['predio_id' => $predioId])->with('success', 'Lote creado con éxito!');
    }

    public function create(Request $request)
    {
        // Obtener el ID del predio desde el parámetro de la URL
        $predioId = $request->query('predio_id');

        // Validar si se envió el ID del predio
        if (!$predioId) {
            return redirect()->route('lotes.index')->with('error', 'Debe seleccionar un predio antes de crear un lote.');
        }

        // Obtener los datos del predio (puedes ajustar según tu repositorio)
        $predio = $this->predioRepo->findPredioById($predioId);

        // Asegurarse de que el predio exista
        if (!$predio) {
            return redirect()->route('lotes.index')->with('error', 'El predio seleccionado no existe.');
        }

        return view('sistema.lotes.form', compact('predio'));
    }


    public function edit($id)
    {
        $lote = $this->loteRepo->show($id);

        return view('sistema.lotes.form', compact('lote'));
    }

    public function show($id)
    {
        $lote = $this->loteRepo->show($id);
        $predioId = request()->query('predio_id');

        return view('sistema.lotes.show', compact('lote'))->with('predio_id', $predioId);
    }

    public function update(UpdateLoteRequest $request, $id)
    {
        $lote = $this->loteRepo->update($request->validated(), $id);
        $predioId = $request->query('predio_id');

        return redirect()->route('lotes.index', ['predio_id' => $predioId])->with('success', 'Lote actualizado con éxito!');
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

    public function getLotesPorPredio(Request $request)
    {
        $predioId = $request->input('predioId');

        // Verifica si se envía el ID del predio
        if (!$predioId) {
            return response()->json(['error' => 'El ID del predio es requerido'], 400);
        }

        // Obtener los lotes asociados al predio
        $lotes = $this->loteRepo->getLotesByPredio($predioId);

        if ($lotes->isEmpty()) {
            return response()->json(['error' => 'No se encontraron lotes para el predio seleccionado'], 404);
        }

        return view('sistema.lotes.partials.lotes_table', compact('lotes'))->render();
    }

    // obtener lote por id contrato
    public function getLoteByContrato($idContrato)
    {
        $lote = $this->loteRepo->getLoteByContrato($idContrato);

        if (!$lote) {
            return response()->json(['error' => 'No se encontró un lote asociado al contrato'], 404);
        }

        return view('sistema.lotes.form', compact('lote'));
    }


}
