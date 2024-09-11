<?php

namespace App\Http\Controllers;

use App\Models\Negocio;
use Illuminate\Http\Request;

class NegocioController extends Controller
{
   // Mostrar una lista de todos los negocios
   public function index()
   {
       $negocios = Negocio::all();
       return response()->json($negocios);
   }

   // Mostrar el formulario para crear un nuevo negocio (usualmente en aplicaciones web)
   public function create()
   {
       //
   }

   // Guardar un nuevo negocio en la base de datos
   public function store(Request $request)
   {
       $negocio = Negocio::create($request->all());
       return response()->json($negocio, 201);
   }

   // Mostrar un negocio específico
   public function show($id)
   {
       $negocio = Negocio::findOrFail($id);
       return response()->json($negocio);
   }

   // Mostrar el formulario para editar un negocio existente (usualmente en aplicaciones web)
   public function edit($id)
   {
       //
   }

   // Actualizar un negocio existente en la base de datos
   public function update(Request $request, $id)
   {
       $negocio = Negocio::findOrFail($id);
       $negocio->update($request->all());
       return response()->json($negocio, 200);
   }

   // Eliminar un negocio específico de la base de datos
   public function destroy($id)
   {
       $negocio = Negocio::findOrFail($id);
       $negocio->delete();
       return response()->json(null, 204);
   }
}
