@extends('adminlte::page')

@section('title', 'Contratos')

@section('content_header')
    <h1>Contratos</h1>
@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Contratos</h3>
            <div class="card-tools">
                <a href="{{ route('contratos.create') }}" class="btn btn-block bg-gradient-primary btn-sm">Nuevo Contrato</a>
            </div>
        </div>
        <div class="card-body">

            @if ($contratos->isEmpty())
                <div class="alert alert-warning">No hay contratos disponibles.</div>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Lote</th>
                            <th>No. Contrato</th>
                            <th>Precio Predio</th>
                            <th>Fecha Celebración</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contratos as $contrato)
                            <tr>
                                <td>{{ $contrato->id }}</td>
                                <td>{{ $contrato->cliente->nombre }} {{ $contrato->cliente->paterno }}</td>
                                <td>{{ $contrato->lote->descripcion }}</td>
                                <td>{{ $contrato->NoContrato }}</td>
                                <td>${{ number_format($contrato->PrecioPredio, 2) }}</td>
                                <td>{{ \Carbon\Carbon::parse($contrato->FechaCelebracion)->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('contratos.show', $contrato->id) }}" class="btn btn-info btn-sm">Ver</a>
                                    <a href="{{ route('contratos.edit', $contrato->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('contratos.destroy', $contrato->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

        </div>
    </div>

@stop
