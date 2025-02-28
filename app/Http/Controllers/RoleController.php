<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;  // Usar el modelo Role de Spatie
use App\Repositories\UserRepositoryInterface;
use Spatie\Permission\Models\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RoleController extends Controller
{
    use AuthorizesRequests;
    // Mostrar una lista de todos los roles
    public function index()
    {
        $roles = Role::all();  // Obtener todos los roles
        return view('sistema.admin.roles.index', compact('roles'));
    }

    // Mostrar el formulario para crear un nuevo rol
    public function create()
    {
        $permissions = Permission::all();  // Obtener todos los permisos disponibles
        return view('sistema.admin.roles.create', compact('permissions'));
    }

    // Almacenar un nuevo rol en la base de datos
    public function store(Request $request)
    {
       // Validar que el nombre del rol sea único
        $request->validate([
            'name' => 'required|unique:roles,name',
            'description' => 'required',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ], [
            'name.required' => 'El nombre del rol es obligatorio.',
            'name.unique' => 'Este rol ya existe en el sistema.',
            'description.required' => 'La descripción es obligatoria.',
            'permissions.*.exists' => 'Uno o más permisos seleccionados no existen.',
        ]);

        // Crear el nuevo rol
        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Asignar permisos al rol
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('roles.index')->with('success', 'Rol creado correctamente.');
    }

    // Mostrar un rol específico
    public function show($id)
    {
        $role = Role::findOrFail($id);  // Buscar el rol por su ID
        $permissions = $role->permissions;  // Obtener los permisos del rol
        return view('sistema.admin.roles.show', compact('role', 'permissions'));
    }

    // Mostrar el formulario para editar un rol
    public function edit($id)
    {
        $role = Role::findOrFail($id);  // Buscar el rol
        $permissions = Permission::all();  // Obtener todos los permisos disponibles
        $rolePermissions = $role->permissions->pluck('id')->toArray();  // Obtener los permisos actuales del rol

        return view('sistema.admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    // Actualizar un rol en la base de datos
    public function update(Request $request, Role $role)
    {
         // Autoriza usando la policy
        $this->authorize('update', $role);

        // Validar los datos
        $request->validate([
            'description' => 'required',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        // Actualizar solo la descripción y permisos
        $role->update([
            'description' => $request->description,
        ]);

        $permissions = Permission::whereIn('name', $request->permissions)->get();
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente.');
    }




    // Eliminar un rol
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);

        // Verificar si el permiso está asignado a algún rol
        if ($permission->roles()->count() > 0) {
            return redirect()->route('permissions.index')
                ->with('error', 'No puedes eliminar este permiso porque está asignado a uno o más roles.');
        }

        // Soft delete (o eliminación permanente si decides hacerlo así)
        $permission->delete();

        return redirect()->route('permissions.index')
            ->with('success', 'Permiso eliminado correctamente.');
    }
}
