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

        <!-- Formulario -->
        <form action="{{ isset($lote) ? route('lotes.update', $lote->id) : route('lotes.store') }}" method="POST">
            @csrf
            @if (isset($lote))
                @method('PUT')
            @endif

            <!-- Card: Información General del Lote -->
            <div class="card card-primary">
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

            <!-- Card: Características del Lote -->
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="mb-0">
                        <a href="#collapseCaracteristicas" class="text-white" data-toggle="collapse" aria-expanded="false" aria-controls="collapseCaracteristicas">
                            <i class="fas fa-info-circle"></i> Características del Lote
                        </a>
                    </h5>
                </div>
                <div id="collapseCaracteristicas" class="collapse">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="regular">Regular</label>
                                <select name="regular" class="form-control">
                                    <option value="1" {{ (old('regular', $lote->regular ?? '') == 1) ? 'selected' : '' }}>Sí</option>
                                    <option value="0" {{ (old('regular', $lote->regular ?? '') == 0) ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="donacion">Donación</label>
                                <select name="donacion" class="form-control">
                                    <option value="1" {{ (old('donacion', $lote->donacion ?? '') == 1) ? 'selected' : '' }}>Sí</option>
                                    <option value="0" {{ (old('donacion', $lote->donacion ?? '') == 0) ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="loteComercial">Lote Comercial</label>
                                <select name="loteComercial" class="form-control">
                                    <option value="1" {{ (old('loteComercial', $lote->loteComercial ?? '') == 1) ? 'selected' : '' }}>Sí</option>
                                    <option value="0" {{ (old('loteComercial', $lote->loteComercial ?? '') == 0) ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="loteReparable">Lote Reparable</label>
                                <input type="text" name="loteReparable" class="form-control" value="{{ old('loteReparable', $lote->loteReparable ?? '') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="loteReparableObs">Observaciones sobre Reparabilidad</label>
                                <textarea name="loteReparableObs" class="form-control">{{ old('loteReparableObs', $lote->loteReparableObs ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card: Dimensiones del Lote -->
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="mb-0">
                        <a href="#collapseDimensiones" class="text-white" data-toggle="collapse" aria-expanded="false" aria-controls="collapseDimensiones">
                            <i class="fas fa-ruler-combined"></i> Dimensiones del Lote
                        </a>
                    </h5>
                </div>
                <div id="collapseDimensiones" class="collapse">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="metrosFrente">Metros Frente</label>
                                <input type="number" step="0.01" name="metrosFrente" class="form-control" value="{{ old('metrosFrente', $lote->metrosFrente ?? '') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="metrosAtras">Metros Atrás</label>
                                <input type="number" step="0.01" name="metrosAtras" class="form-control" value="{{ old('metrosAtras', $lote->metrosAtras ?? '') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="metrosDerecho">Metros Derecho</label>
                                <input type="number" step="0.01" name="metrosDerecho" class="form-control" value="{{ old('metrosDerecho', $lote->metrosDerecho ?? '') }}" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="metrosIzquierda">Metros Izquierda</label>
                                <input type="number" step="0.01" name="metrosIzquierda" class="form-control" value="{{ old('metrosIzquierda', $lote->metrosIzquierda ?? '') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="metrosCuadrados">Metros Cuadrados</label>
                                <input type="number" step="0.01" name="metrosCuadrados" class="form-control" value="{{ old('metrosCuadrados', $lote->metrosCuadrados ?? '') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="precio">Precio</label>
                                <input type="number" step="0.01" name="precio" class="form-control" value="{{ old('precio', $lote->precio ?? '') }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card: Plan de Pago -->
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="mb-0">
                        <a href="#collapsePago" class="text-white" data-toggle="collapse" aria-expanded="false" aria-controls="collapsePago">
                            <i class="fas fa-dollar-sign"></i> Plan de Pago
                        </a>
                    </h5>
                </div>
                <div id="collapsePago" class="collapse">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="plazoMeses">Plazo (Meses)</label>
                                <input type="number" name="plazoMeses" class="form-control" value="{{ old('plazoMeses', $lote->plazoMeses ?? '') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="pagoMensual">Pago Mensual</label>
                                <input type="number" step="0.01" name="pagoMensual" class="form-control" value="{{ old('pagoMensual', $lote->pagoMensual ?? '') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="estatusPago">Estatus de Pago</label>
                                <select name="estatusPago" class="form-control">
                                    <option value="pendiente" {{ (old('estatusPago', $lote->estatusPago ?? '') == 'pendiente') ? 'selected' : '' }}>Pendiente</option>
                                    <option value="pagado" {{ (old('estatusPago', $lote->estatusPago ?? '') == 'pagado') ? 'selected' : '' }}>Pagado</option>
                                    <option value="atrasado" {{ (old('estatusPago', $lote->estatusPago ?? '') == 'atrasado') ? 'selected' : '' }}>Atrasado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botón de enviar -->
         
             <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    {{ isset($lote) ? 'Actualizar Lote' : 'Crear Lote' }}
                </button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
            </div>

        </form>
    </div>
@stop

@section('js')
    <script>
        // Iniciar todas las colapsibles cerradas
        $('.collapse').collapse('hide');
    </script>
@stop
