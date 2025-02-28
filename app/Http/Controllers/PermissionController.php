<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('sistema.admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('sistema.admin.permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        Permission::create($request->all());

        return redirect()->route('sistema.admin.permissions.index')
                         ->with('success', 'Permission created successfully.');
    }

    public function show($id)
    {
        $permission = Permission::find($id);
        return view('sistema.admin.permissions.show', compact('permission'));
    }

    public function edit($id)
    {
        $permission = Permission::find($id);
        return view('sistema.admin.permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $id,
        ]);

        $permission = Permission::find($id);
        $permission->update($request->all());

        return redirect()->route('sistema.admin.permissions.index')
                         ->with('success', 'Permission updated successfully.');
    }

    public function destroy($id)
    {
        Permission::find($id)->delete();
        return redirect()->route('sistema.admin.permissions.index')
                         ->with('success', 'Permission deleted successfully.');
    }
}
