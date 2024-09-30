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
                            <input type="text" name="regular" class="form-control"
                                   value="{{ $lote->regular ? 'Sí' : 'No' }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="donacion">Donación</label>
                            <input type="text" name="donacion" class="form-control"
                                   value="{{ $lote->donacion ? 'Sí' : 'No' }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="loteComercial">Lote Comercial</label>
                            <input type="text" name="loteComercial" class="form-control"
                                   value="{{ $lote->loteComercial ? 'Sí' : 'No' }}" readonly>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="loteReparable">Lote Reparable</label>
                            <input type="text" name="loteReparable" class="form-control"
                                   value="{{ $lote->loteReparable ?? 'N/A' }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="loteReparableObs">Observaciones sobre Reparabilidad</label>
                            <textarea name="loteReparableObs" class="form-control" readonly>{{ $lote->loteReparableObs }}</textarea>
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
                            <input type="text" name="metrosFrente" class="form-control" value="{{ $lote->metrosFrente }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="metrosAtras">Metros Atrás</label>
                            <input type="text" name="metrosAtras" class="form-control" value="{{ $lote->metrosAtras }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="metrosDerecho">Metros Derecho</label>
                            <input type="text" name="metrosDerecho" class="form-control" value="{{ $lote->metrosDerecho }}" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="metrosIzquierda">Metros Izquierda</label>
                            <input type="text" name="metrosIzquierda" class="form-control" value="{{ $lote->metrosIzquierda }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="metrosCuadrados">Metros Cuadrados</label>
                            <input type="text" name="metrosCuadrados" class="form-control" value="{{ $lote->metrosCuadrados }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="precio">Precio</label>
                            <input type="text" name="precio" class="form-control" value="{{ $lote->precio }}" readonly>
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
                            <input type="text" name="plazoMeses" class="form-control" value="{{ $lote->plazoMeses ?? 'N/A' }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="pagoMensual">Pago Mensual</label>
                            <input type="text" name="pagoMensual" class="form-control" value="{{ $lote->pagoMensual ?? 'N/A' }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="estatusPago">Estatus de Pago</label>
                            <input type="text" name="estatusPago" class="form-control" value="{{ ucfirst($lote->estatusPago) }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('lotes.index') }}" class="btn btn-block bg-gradient-secondary">Regresar</a>

    </div>
@stop

@section('js')
    <script>
        // Iniciar todas las colapsibles cerradas
        $('.collapse').collapse('hide');
    </script>
@stop
