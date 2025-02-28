<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RolePermissionMiddleware
{
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        if (!Auth::check()) {
            abort(Response::HTTP_FORBIDDEN, 'No estás autenticado.');
        }

        //$user = Auth::user(); // Ya tiene roles y permisos cargados
        $user = User::with('roles.permissions')->find(Auth::id()); // 🔹 Cargar roles y permisos explícitamente


        if (!$user->hasPermissionTo($permission)) {
            abort(Response::HTTP_FORBIDDEN, 'No tienes permisos para acceder.');
        }

        return $next($request);
        // if (!Auth::check()) {
        //     abort(Response::HTTP_FORBIDDEN, 'No estás autenticado.');
        // }

        // $user = Auth::user();
        // $user = User::with('roles.permissions')->find($user->id); // 🔹 Cargar roles y permisos

        // // Comprobar si el usuario tiene permiso
        // if (!$user->hasPermissionTo($permission)) {
        //     abort(Response::HTTP_FORBIDDEN, 'No tienes permisos para acceder.');
        // }

        // return $next($request);
    }
}
