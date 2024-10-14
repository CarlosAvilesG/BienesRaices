@extends('adminlte::page')

@section('title', 'Detalles del Contrato')

@section('content_header')
    <h1>Detalles del Contrato</h1>
@stop

@section('content')
    <div class="container">
        <!-- Mensaje de éxito si existe -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Card: Información General del Contrato -->
        <div class="card card-primary">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-file-contract"></i> Información General del Contrato</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="NoContrato">No. de Contrato</label>
                        <p>{{ $contrato->NoContrato }}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="Cliente">Cliente</label>
                        <p>{{ $contrato->cliente->nombre }} {{ $contrato->cliente->paterno }}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="Lote">Lote</label>
                        <p>{{ $contrato->lote->descripcion }}</p>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="PrecioPredio">Precio del Predio</label>
                        <p>${{ number_format($contrato->PrecioPredio, 2) }}</p>
                    </div>
                    <div class="col-md-6">
                        <label for="FechaCelebracion">Fecha de Celebración</label>
                        <p>{{ \Carbon\Carbon::parse($contrato->FechaCelebracion)->format('d/m/Y') }}</p>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="FechaRegistro">Fecha de Registro</label>
                        <p>{{ \Carbon\Carbon::parse($contrato->FechaRegistro)->format('d/m/Y') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label for="HoraRegistro">Hora de Registro</label>
                        <p>{{ $contrato->HoraRegistro }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{--  Botón para generar PDF el contrato de promesa de venta --}}
        <a href="{{ route('contrato.promesa.pdf', $contrato->id) }}" class="btn btn-secondary">Generar Contrato de Promesa de Venta</a>

        <!-- Botón para regresar al listado -->
        <a href="{{ route('contratos.index') }}" class="btn btn-block bg-gradient-secondary">Regresar</a>
    </div>
@stop
