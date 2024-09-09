<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{


// Mostrar una lista de todos los clientes
public function index()
{
    $clientes = Cliente::all();
    return response()->json($clientes);
}

// Guardar un nuevo cliente en la base de datos
public function store(Request $request)
{
    // Validaciones
    $validatedData = $request->validate([
        'paterno' => 'required|string|max:30',
        'materno' => 'required|string|max:30',
        'nombre' => 'required|string|max:30',
        'curp' => 'required|string|max:30|unique:clientes,curp',
        'rfc' => 'required|string|max:30|unique:clientes,rfc',
        'ine' => 'required|string|max:90|unique:clientes,ine',
        'direccion' => 'nullable|string|max:300',
        'direccionEntreCalle' => 'nullable|string|max:50',
        'codigoPostal' => 'nullable|integer',
        'colonia' => 'nullable|string|max:50',
        'numeroExterior' => 'nullable|char|max:10',
        'telefonoCasa' => 'nullable|string|max:30',
        'celular' => 'required|string|max:30',
        'trabajo' => 'nullable|string|max:100',
        'trabajoDireccion' => 'nullable|string|max:300',
        'trabajoTelefono' => 'nullable|string|max:30',
        'estadoRepublica' => 'nullable|string|max:30',
        'municipio' => 'nullable|string|max:45',
        'localidad' => 'nullable|string|max:45',
        'correoElectronico' => 'required|string|max:45|unique:clientes,correoElectronico',
        'pass' => 'required|string|max:60',
        'usuarioWeb' => 'nullable|string|max:45',
        'foto_url' => 'nullable|string',
        'fechaRegistro' => 'required|date',
        'morosidad_activa' => 'boolean',
        'monto_deuda_actual' => 'numeric|min:0',
        'ultima_actualizacion_morosidad' => 'nullable|date',
        'idUsuario' => 'required|exists:users,id'
    ]);

    // Crear un nuevo registro
    $cliente = Cliente::create($validatedData);

    return response()->json($cliente, 201);
}

// Mostrar un cliente específico
public function show($id)
{
    $cliente = Cliente::findOrFail($id);
    return response()->json($cliente);
}

// Actualizar un cliente existente en la base de datos
public function update(Request $request, $id)
{
    // Validaciones
    $validatedData = $request->validate([
        'paterno' => 'sometimes|required|string|max:30',
        'materno' => 'sometimes|required|string|max:30',
        'nombre' => 'sometimes|required|string|max:30',
        'curp' => 'sometimes|required|string|max:30|unique:clientes,curp,'.$id.',idCliente',
        'rfc' => 'sometimes|required|string|max:30|unique:clientes,rfc,'.$id.',idCliente',
        'ine' => 'sometimes|required|string|max:90|unique:clientes,ine,'.$id.',idCliente',
        'direccion' => 'nullable|string|max:300',
        'direccionEntreCalle' => 'nullable|string|max:50',
        'codigoPostal' => 'nullable|integer',
        'colonia' => 'nullable|string|max:50',
        'numeroExterior' => 'nullable|char|max:10',
        'telefonoCasa' => 'nullable|string|max:30',
        'celular' => 'sometimes|required|string|max:30',
        'trabajo' => 'nullable|string|max:100',
        'trabajoDireccion' => 'nullable|string|max:300',
        'trabajoTelefono' => 'nullable|string|max:30',
        'estadoRepublica' => 'nullable|string|max:30',
        'municipio' => 'nullable|string|max:45',
        'localidad' => 'nullable|string|max:45',
        'correoElectronico' => 'sometimes|required|string|max:45|unique:clientes,correoElectronico,'.$id.',idCliente',
        'pass' => 'sometimes|required|string|max:60',
        'usuarioWeb' => 'nullable|string|max:45',
        'foto_url' => 'nullable|string',
        'fechaRegistro' => 'required|date',
        'morosidad_activa' => 'boolean',
        'monto_deuda_actual' => 'numeric|min:0',
        'ultima_actualizacion_morosidad' => 'nullable|date',
        'idUsuario' => 'required|exists:users,id'
    ]);

    // Buscar y actualizar el registro
    $cliente = Cliente::findOrFail($id);
    $cliente->update($validatedData);

    return response()->json($cliente, 200);
}

// Eliminar un cliente específico de la base de datos
public function destroy($id)
{
    $cliente = Cliente::findOrFail($id);
    $cliente->delete();

    return response()->json(null, 204);
}


}
