@extends('adminlte::page')

@section('title', 'Editar Cliente')

@section('content_header')
    <h1>Editar Cliente</h1>
@stop

@section('content')
<div class="container">
    <form action="{{ route('clientes.update', $cliente->idCliente) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $cliente->nombre }}" required>
        </div>
        <div class="form-group">
            <label for="paterno">Apellido Paterno</label>
            <input type="text" name="paterno" class="form-control" value="{{ $cliente->paterno }}" required>
        </div>
        <div class="form-group">
            <label for="materno">Apellido Materno</label>
            <input type="text" name="materno" class="form-control" value="{{ $cliente->materno }}" required>
        </div>
        <div class="form-group">
            <label for="correoElectronico">Correo Electrónico</label>
            <input type="email" name="correoElectronico" class="form-control" value="{{ $cliente->correoElectronico }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@stop
