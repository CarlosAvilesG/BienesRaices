<?php

namespace App\Http\Controllers;

use App\Models\Predio;
use Illuminate\Http\Request;

class PredioController extends Controller
{
      // Mostrar una lista de todos los predios
      public function index()
      {
          $predios = Predio::all();
          return response()->json($predios);
      }

      // Mostrar el formulario para crear un nuevo predio (si es necesario)
      public function create()
      {
          // Aquí podrías retornar una vista si es una aplicación web
      }

      // Almacenar un nuevo predio en la base de datos
      public function store(Request $request)
      {
          // Validaciones
          $validated = $request->validate([
              'nombre' => 'required|string|max:30',
              'descripcion' => 'required|string|max:100',
              'estadoRepublica' => 'required|string|max:30',
              'municipio' => 'required|string|max:30',
              'localidad' => 'required|string|max:30',
              'hectarias' => 'required|integer|min:0',
              'numeroManzanas' => 'required|integer|min:0',
              'numeroLotes' => 'required|integer|min:0',
              'fechaInauguracion' => 'required|date',
              'activo' => 'boolean',
          ]);

          // Crear el predio
          $predio = Predio::create($validated);

          return response()->json($predio, 201);
      }

      // Mostrar un predio específico
      public function show($id)
      {
          $predio = Predio::findOrFail($id);
          return response()->json($predio);
      }

      // Mostrar el formulario para editar un predio existente (si es necesario)
      public function edit($id)
      {
          // Aquí podrías retornar una vista si es una aplicación web
      }

      // Actualizar un predio existente
      public function update(Request $request, $id)
      {
          // Validaciones
          $validated = $request->validate([
              'nombre' => 'required|string|max:30',
              'descripcion' => 'required|string|max:100',
              'estadoRepublica' => 'required|string|max:30',
              'municipio' => 'required|string|max:30',
              'localidad' => 'required|string|max:30',
              'hectarias' => 'required|integer|min:0',
              'numeroManzanas' => 'required|integer|min:0',
              'numeroLotes' => 'required|integer|min:0',
              'fechaInauguracion' => 'required|date',
              'activo' => 'boolean',
          ]);

          // Encontrar y actualizar el predio
          $predio = Predio::findOrFail($id);
          $predio->update($validated);

          return response()->json($predio);
      }

      // Eliminar un predio
      public function destroy($id)
      {
          $predio = Predio::findOrFail($id);
          $predio->delete();

          return response()->json(null, 204);
      }
}
