@extends('adminlte::page')

@section('title', 'Editar Rol')

@section('content_header')
    <h1>Editar Rol</h1>
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
            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nombre del Rol -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre del Rol</label>
                    <input type="text" name="name" class="form-control" value="{{ $role->name }}" required>
                </div>

                <!-- Descripción del Rol -->
                <div class="mb-3">
                    <label for="description" class="form-label">Descripción del Rol</label>
                    <textarea name="description" class="form-control" rows="2" required>{{ $role->description }}</textarea>
                </div>

                <!-- Permisos Disponibles -->
                <div class="mb-3">
                    <label class="form-label">Permisos Asignados</label>
                    <div class="row">
                        @foreach ($permissions as $permission)
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                           value="{{ $permission->name }}"
                                           {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                    <label class="form-check-label">
                                        <strong>{{ $permission->name }}</strong> <br>
                                        <small class="text-muted">{{ $permission->description }}</small>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

@stop
