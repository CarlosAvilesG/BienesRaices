<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePredioRequest;
use App\Http\Requests\UpdatePredioRequest;
use App\Repositories\PredioRepositoryInterface;

class PredioController extends Controller
{
    protected $predioRepo;

    public function __construct(PredioRepositoryInterface $predioRepo)
    {
        $this->predioRepo = $predioRepo;
    }

    // Mostrar una lista de todos los predios
    public function index()
    {
      //  return "PredioController index";

        $predios = $this->predioRepo->getAll();

       // dd($predios); // Aquí puedes ver si está retornando algo

        return view('sistema.predios.index', compact('predios'));
       // return response()->json($predios);
    }

    public function create()
    {
      // return "entro a create";

        return view('sistema.predios.form');//, compact('predio'));
    }

    public function edit($id)
    {
        //return "termino edit";

        $predio = $this->predioRepo->findPredioById($id);
        return view('sistema.predios.form', compact('predio'));
        //return response()->json($predio);
    }


    // Almacenar un nuevo predio en la base de datos
    public function store(StorePredioRequest $request)
    {
       // return "termino store";

        $predio = $this->predioRepo->createPredio($request->validated()).with('success', 'Predio creado con exito!');
      //  return response()->json($predio, 201);
       //return redirect()->route('predios.show', $predio->id);

    }

    // Mostrar un predio específico
    public function show($id)
    {
       // return "termino show";

        $predio = $this->predioRepo->findPredioById($id);
        //return response()->json($predio);

        return view('sistema.predios.show', compact('predio'));

    }

    // Actualizar un predio existente
    public function update(UpdatePredioRequest $request, $id)
    {
       // return "termino update";

        $predio = $this->predioRepo->updatePredio($id, $request->validated()).with('success', 'Predio actualizado con exito!');


        // return response()->json($predio);

    }

    // Eliminar un predio
    public function destroy($id)
    {
        //return "termino destroy";

        $this->predioRepo->deletePredio($id).with('success', 'Predio eliminado con exito!');
        //return response()->json(null, 204);
    }
}
