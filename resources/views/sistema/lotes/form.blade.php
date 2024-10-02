@extends('adminlte::page')

@section('title', isset($lote) ? 'Editar Lote' : 'Crear Lote')

@section('content_header')
    <h1>{{ isset($lote) ? 'Editar Lote' : 'Crear Lote' }}</h1>
@stop

@section('content')
    <div class="container">

        <!-- Mostrar mensaje de éxito si existe -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Mostrar errores de validación si existen -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Card: Información del Predio -->
        <div class="card card-info">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> Información del Predio</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <strong>ID del Predio:</strong>
                        <p>{{ isset($lote) ? $lote->predio->id : $predio->id }}</p>
                    </div>
                    <div class="col-md-4">
                        <strong>Nombre:</strong>
                        <p>{{ isset($lote) ? $lote->predio->nombre : $predio->nombre }}</p>
                    </div>
                    <div class="col-md-4">
                        <strong>Descripción:</strong>
                        <p>{{ isset($lote) ? $lote->predio->descripcion : $predio->descripcion }}</p>
                    </div>
                </div>
                <!-- Input oculto para enviar el ID del predio con el formulario -->
                <input type="hidden" name="idPredio" value="{{ isset($lote) ? $lote->predio->id : $predio->id }}">
            </div>
        </div>

        <!-- Formulario para crear/editar lote -->
        <form action="{{ isset($lote) ? route('lotes.update', $lote->id) . '?predio_id=' . (isset($lote) ? $lote->predio->id : $predio->id) : route('lotes.store') . '?predio_id=' . request()->get('predio_id') }}" method="POST">
            @csrf
            @if (isset($lote))
                @method('PUT')
            @endif

            <!-- Card: Información General del Lote -->
            <div class="card card-primary mt-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-layer-group"></i> Información General del Lote</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="manzana">Manzana</label>
                            <input type="number" name="manzana" class="form-control" value="{{ old('manzana', $lote->manzana ?? '') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="lote">Lote</label>
                            <input type="number" name="lote" class="form-control" value="{{ old('lote', $lote->lote ?? '') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="descripcion">Descripción</label>
                            <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion', $lote->descripcion ?? '') }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botón de enviar -->
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">
                    {{ isset($lote) ? 'Actualizar Lote' : 'Crear Lote' }}
                </button>
                <!-- Botón de cancelar, regresando al listado de lotes con el predio_id -->
                <a href="{{ route('lotes.index', ['predio_id' => request()->get('predio_id')]) }}" class="btn btn-secondary">Cancelar</a>
            </div>

        </form>
    </div>
@stop
