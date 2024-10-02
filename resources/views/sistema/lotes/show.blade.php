@extends('adminlte::page')

@section('title', 'Detalles del Lote')

@section('content_header')
    <h1>Detalles del Lote</h1>
@stop

@section('content')
    <div class="container">
        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Errores de validación -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Card: Información General del Lote -->
        <div class="card card-primary">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-layer-group"></i> Información General del Lote</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="manzana">Manzana</label>
                        <input type="text" name="manzana" class="form-control" value="{{ $lote->manzana }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="lote">Lote</label>
                        <input type="text" name="lote" class="form-control" value="{{ $lote->lote }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="descripcion">Descripción</label>
                        <input type="text" name="descripcion" class="form-control" value="{{ $lote->descripcion }}" readonly>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botón para regresar al listado, preservando el predio_id -->
        <a href="{{ route('lotes.index', ['predio_id' => request()->get('predio_id')]) }}" class="btn btn-block bg-gradient-secondary">Regresar</a>
    </div>
@stop
