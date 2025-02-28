@extends('adminlte::page')

@section('title', 'Asignar Permisos')

@section('content_header')
    <h1>Asignar Permisos a Roles</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('permissions.assign.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Seleccionar Rol</label>
                <select name="role_id" class="form-control" required>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Seleccionar Permisos</label>
                @foreach ($permissions as $permission)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}">
                        <label class="form-check-label">{{ $permission->name }}</label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-success">Asignar Permisos</button>
        </form>
    </div>
</div>
@stop
