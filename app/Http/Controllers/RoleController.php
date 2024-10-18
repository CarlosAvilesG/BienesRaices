<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;  // Usar el modelo Role de Spatie
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    // Mostrar una lista de todos los roles
    public function index()
    {
        $roles = Role::all();  // Obtener todos los roles
        return view('roles.index', compact('roles'));
    }

    // Mostrar el formulario para crear un nuevo rol
    public function create()
    {
        $permissions = Permission::all();  // Obtener todos los permisos disponibles
        return view('roles.create', compact('permissions'));
    }

    // Almacenar un nuevo rol en la base de datos
    public function store(Request $request)
    {
        // Validar el formulario con reglas personalizadas
        $request->validate([
            'name' => 'required|unique:roles|max:255',
            'permissions' => 'array|nullable',  // Validar que permisos sea un array
        ], [
            'name.required' => 'El nombre del rol es obligatorio.',
            'name.unique' => 'Este rol ya existe.',
            'permissions.array' => 'Los permisos deben ser un arreglo válido.',
        ]);

        // Crear el rol
        $role = Role::create(['name' => $request->name]);

        // Asignar permisos al rol (si se seleccionaron permisos)
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('roles.index')->with('success', 'Rol creado con éxito.');
    }

    // Mostrar un rol específico
    public function show($id)
    {
        $role = Role::findOrFail($id);  // Buscar el rol por su ID
        $permissions = $role->permissions;  // Obtener los permisos del rol
        return view('roles.show', compact('role', 'permissions'));
    }

    // Mostrar el formulario para editar un rol
    public function edit($id)
    {
        $role = Role::findOrFail($id);  // Buscar el rol
        $permissions = Permission::all();  // Obtener todos los permisos disponibles
        $rolePermissions = $role->permissions->pluck('id')->toArray();  // Obtener los permisos actuales del rol

        return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    // Actualizar un rol en la base de datos
    public function update(Request $request, $id)
    {
        // Validar el formulario de actualización
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id . '|max:255',
            'permissions' => 'array|nullable',
        ], [
            'name.required' => 'El nombre del rol es obligatorio.',
            'name.unique' => 'Este rol ya existe.',
            'permissions.array' => 'Los permisos deben ser un arreglo válido.',
        ]);

        // Buscar y actualizar el rol
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();

        // Actualizar permisos (sincronizarlos)
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        } else {
            $role->syncPermissions([]);  // Remover todos los permisos si no se selecciona ninguno
        }

        return redirect()->route('roles.index')->with('success', 'Rol actualizado con éxito.');
    }

    // Eliminar un rol
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();  // Eliminar el rol

        return redirect()->route('roles.index')->with('success', 'Rol eliminado con éxito.');
    }
}
