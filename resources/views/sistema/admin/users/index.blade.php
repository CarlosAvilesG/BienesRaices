@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Gestión de Usuarios</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('users.create') }}" class="btn btn-primary">Nuevo Usuario</a>
    </div>

    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>

                        <td>{{ $user->paterno }}</td>
                        <td>{{ $user->materno }}</td>
                        <td>{{ $user->nombre }}</td>

                        <td>{{ $user->email }}</td>

                         <td>
                                @if ($user->roles->isNotEmpty())
                                    {{ $user->roles->pluck('name')->join(', ') }}
                                @else
                                    <span class="badge badge-secondary">Sin rol</span>
                                @endif
                            </td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar usuario?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop


@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable();
        });
    </script>
@stop
