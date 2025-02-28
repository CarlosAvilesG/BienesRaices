@extends('adminlte::page')

@section('title', 'Lista de Roles')

@section('content_header')
    <h1>Lista de Roles</h1>
@stop

@section('content')

 <!-- Mensaje de éxito -->
 @if (session('success'))
 <div class="alert alert-success">
     {{ session('success') }}
 </div>
@endif

<!-- Errores de validación -->
@if ($errors->any())
 <div class="alert alert-danger">
     <ul>
         @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
         @endforeach
     </ul>
 </div>
@endif

    <div class="card">
        <div class="card-body">
            @can('roles.create', App\Models\Role::class)
                <a href="{{ route('roles.create') }}" class="btn btn-success">Nuevo Rol</a>
            @endcan

            <table id="rolesTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Permisos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->description }}</td>
                            <td>
                                @if($role->permissions->isNotEmpty())
                                    <span class="badge bg-primary"
                                          data-bs-toggle="tooltip"
                                          data-bs-html="true"
                                          title="{{ implode('<br>', $role->permissions->pluck('name')->toArray()) }}">
                                        {{ $role->permissions->count() }} Permisos
                                    </span>
                                @else
                                    <span class="badge bg-secondary">Sin permisos</span>
                                @endif
                            </td>
                            <td>
                                @can('roles.edit', $role)
                                     <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endcan
                            @can('roles.delete', $role)
                                 <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Seguro que deseas eliminar este rol?')">
                                    <i class="fas fa-trash"></i>
                                 </button>
                              </form>
                          @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
@stop

@section('js')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#rolesTable').DataTable({
                responsive: true,
                autoWidth: false
            });

            // Activa tooltips con HTML permitido
            $('[data-bs-toggle="tooltip"]').tooltip({
                html: true
            });
        });
    </script>

@stop
