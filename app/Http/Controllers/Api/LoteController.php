<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use App\Models\LoteFoto;
use Illuminate\Http\Request;

class LoteController extends Controller
{
     // Mostrar una lista de todos los lotes
     public function index()
     {
         $lotes = Lote::all();
         return response()->json($lotes);
     }

     // Mostrar el formulario para crear un nuevo lote (si es necesario)
     public function create()
     {
         // Aquí podrías retornar una vista si es una aplicación web
     }

     // Almacenar un nuevo lote en la base de datos
     public function store(Request $request)
     {
         // Validaciones
         $validated = $request->validate([
             'idPredio' => 'required|exists:predio,idPredio',
             'manzana' => 'required|integer|min:0',
             'lote' => 'required|integer|min:0',
             'descripcion' => 'nullable|string|max:50',
             'regular' => 'required|boolean',
             'donacion' => 'required|boolean',
             'loteComercial' => 'required|boolean',
             'loteReparable' => 'nullable|string|max:5',
             'loteReparableObs' => 'nullable|string|max:300',
             'inhabilitado' => 'required|boolean',
             'metrosFrente' => 'required|numeric|min:0',
             'metrosAtras' => 'required|numeric|min:0',
             'metrosDerecho' => 'required|numeric|min:0',
             'metrosIzquierda' => 'required|numeric|min:0',
             'metrosCuadrados' => 'required|numeric|min:0',
             'precio' => 'required|numeric|min:0',
             'plazoMeses' => 'nullable|integer|min:0',
             'pagoMensual' => 'nullable|numeric|min:0',
             'estatusPago' => 'required|in:pendiente,pagado,atrasado',
         ]);

         // Crear el lote
         $lote = Lote::create($validated);

         return response()->json($lote, 201);
     }

     // Mostrar un lote específico
     public function show($id)
     {
         $lote = Lote::findOrFail($id);
         return response()->json($lote);
     }

     // Mostrar el formulario para editar un lote existente (si es necesario)
     public function edit($id)
     {
         // Aquí podrías retornar una vista si es una aplicación web
     }

     // Actualizar un lote existente
     public function update(Request $request, $id)
     {
         // Validaciones
         $validated = $request->validate([
             'idPredio' => 'required|exists:predio,idPredio',
             'manzana' => 'required|integer|min:0',
             'lote' => 'required|integer|min:0',
             'descripcion' => 'nullable|string|max:50',
             'regular' => 'required|boolean',
             'donacion' => 'required|boolean',
             'loteComercial' => 'required|boolean',
             'loteReparable' => 'nullable|string|max:5',
             'loteReparableObs' => 'nullable|string|max:300',
             'inhabilitado' => 'required|boolean',
             'metrosFrente' => 'required|numeric|min:0',
             'metrosAtras' => 'required|numeric|min:0',
             'metrosDerecho' => 'required|numeric|min:0',
             'metrosIzquierda' => 'required|numeric|min:0',
             'metrosCuadrados' => 'required|numeric|min:0',
             'precio' => 'required|numeric|min:0',
             'plazoMeses' => 'nullable|integer|min:0',
             'pagoMensual' => 'nullable|numeric|min:0',
             'estatusPago' => 'required|in:pendiente,pagado,atrasado',
         ]);

         // Encontrar y actualizar el lote
         $lote = Lote::findOrFail($id);
         $lote->update($validated);

         return response()->json($lote);
     }

     // Eliminar un lote
     public function destroy($id)
     {
         $lote = Lote::findOrFail($id);
         $lote->delete();

         return response()->json(null, 204);
     }





        // Método para agregar una foto a un lote
        public function addFoto(Request $request, $idLote)
        {
            // Validaciones
            $validated = $request->validate([
                'foto_url' => 'required|string|max:255',
            ]);

            // Verificar que el lote existe
            $lote = Lote::findOrFail($idLote);

            // Crear la foto asociada al lote
            $loteFoto = new LoteFoto([
                'idLote' => $lote->idLote,
                'foto_url' => $validated['foto_url'],
            ]);
            $loteFoto->save();

            return response()->json($loteFoto, 201);
        }

        // Método para listar todas las fotos de un lote
        public function getFotos($idLote)
        {
            // Verificar que el lote existe
            $lote = Lote::findOrFail($idLote);

            // Obtener todas las fotos asociadas al lote
            $fotos = $lote->fotos;

            return response()->json($fotos);
        }

        // Método para eliminar una foto específica de un lote
        public function deleteFoto($idLote, $idFoto)
        {
            // Verificar que el lote existe
            $lote = Lote::findOrFail($idLote);

            // Verificar que la foto pertenece al lote
            $foto = LoteFoto::where('idLote', $lote->idLote)->where('id', $idFoto)->firstOrFail();

            // Eliminar la foto
            $foto->delete();

            return response()->json(null, 204);
        }


}
