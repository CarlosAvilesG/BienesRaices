<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepositoryInterface;
use Spatie\Permission\Models\Role;


use Illuminate\Routing\Controller;

class UserController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;

        $this->middleware('auth');

        $this->middleware('can:users.index')->only('index');
        $this->middleware('can:users.create')->only(['create', 'store']);
        $this->middleware('can:users.edit')->only(['edit', 'update']);
        $this->middleware('can:users.delete')->only('destroy');

    }

    // Obtener todos los usuarios
    public function index()
    {
        $users = $this->userRepo->getAllUsers()->load('roles'); // Carga los roles después de obtener los datos

        return view('sistema.admin.users.index', compact('users'));
       // return response()->json($users);
    }
    public function create() {
        return view('sistema.admin.users.create');
    }

    // Crear un nuevo usuario
    public function store(StoreUserRequest $request)
    {
        $user = $this->userRepo->createUser($request->validated());

        if ($request->has('roles')) {
            $user->assignRole($request->roles); // 🔹 Asigna roles seleccionados
        }

        return redirect()->route('sistema.admin.users.index')->with('success', 'Usuario creado correctamente.');
       // return response()->json($user, 201);
    }

    public function edit( $user) {
        $user = $this->userRepo->findUserById($user);
        $roles = Role::all();
        return view('sistema.admin.users.edit', compact('user', 'roles'));
    }

    // Mostrar un usuario específico
    public function show($id)
    {
        $user = $this->userRepo->findUserById($id);

        return view('sistema.admin.users.show', compact('user'));

        //return response()->json($user);
    }

    // Actualizar un usuario existente
    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->userRepo->findUserById($id);


        $user->update($request->validated());

        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        }

        return redirect()->route('users.index')->with('success', 'Usuario actualizado.');
    }

    // Eliminar un usuario
    public function destroy($id)
    {
        $user = $this->userRepo->findUserById($id);

        if ($user->hasRole('SuperUsuario')) {
            return redirect()->route('users.index')->with('error', 'No puedes eliminar este usuario.');
        }

        $this->userRepo->deleteUser($id);

        return redirect()->route('users.index')->with('success', 'Usuario eliminado.');
    }
}
