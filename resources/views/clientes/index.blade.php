@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Clientes</h1>
@stop

@section('content')
<p> Lista de clientes</p>

<!-- Si no hay clientes -->
@if($clientes->isEmpty())
    <div class="alert alert-warning">No hay clientes disponibles.</div>
@else
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Correo Electrónico</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->paterno }}</td>
                    <td>{{ $cliente->materno }}</td>
                    <td>{{ $cliente->correoElectronico }}</td>
                    {{-- <td>
                        <a href="{{ route('clientes.show', $cliente->idCliente) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('clientes.edit', $cliente->idCliente) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('clientes.destroy', $cliente->idCliente) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                        </form>
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop

{{--
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Lista de Clientes</h1>

    <!-- Si no hay clientes -->
    @if($clientes->isEmpty())
        <div class="alert alert-warning">No hay clientes disponibles.</div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Correo Electrónico</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->idCliente }}</td>
                        <td>{{ $cliente->nombre }}</td>
                        <td>{{ $cliente->paterno }}</td>
                        <td>{{ $cliente->materno }}</td>
                        <td>{{ $cliente->correoElectronico }}</td>
                        {{-- <td>
                            <a href="{{ route('clientes.show', $cliente->idCliente) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('clientes.edit', $cliente->idCliente) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('clientes.destroy', $cliente->idCliente) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection --}}
