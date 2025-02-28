@extends('adminlte::page')

@section('title', 'Crear Nuevo Rol')

@section('content_header')
    <h1>Crear Nuevo Rol</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">

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

            <form action="{{ route('roles.store') }}" method="POST">
                @csrf

                {{-- Nombre del Rol --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre del Rol</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}" placeholder="Ej. Administrador" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Descripción del Rol --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                              rows="2" placeholder="Descripción del rol" required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Permisos --}}
                <div class="mb-3">
                    <label class="form-label">Permisos</label>
                    <div class="row">
                        @foreach($permissions as $permission)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                           value="{{ $permission->id }}" id="perm_{{ $permission->id }}">
                                    <label class="form-check-label" for="perm_{{ $permission->id }}">
                                        <strong>{{ $permission->name }}</strong><br>
                                        <small class="text-muted">{{ $permission->description }}</small>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Botones --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Guardar Rol
                    </button>
                </div>

            </form>
        </div>
    </div>

@stop
