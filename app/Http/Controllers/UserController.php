<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepositoryInterface;

class UserController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    // Obtener todos los usuarios
    public function index()
    {
        $users = $this->userRepo->getAllUsers();
        return response()->json($users);
    }

    // Crear un nuevo usuario
    public function store(StoreUserRequest $request)
    {
        $user = $this->userRepo->createUser($request->validated());
        return response()->json($user, 201);
    }

    // Mostrar un usuario específico
    public function show($id)
    {
        $user = $this->userRepo->findUserById($id);
        return response()->json($user);
    }

    // Actualizar un usuario existente
    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->userRepo->updateUser($id, $request->validated());
        return response()->json($user);
    }

    // Eliminar un usuario
    public function destroy($id)
    {
        $this->userRepo->deleteUser($id);
        return response()->json(null, 204);
    }
}
