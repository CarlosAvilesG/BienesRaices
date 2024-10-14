@extends('adminlte::page')


@section('title', 'Editar Contrato')

@section('content_header')
    <h1>Editar Contrato</h1>
@stop

@section('content')
    <div class="container">

        <!-- Mensaje de éxito si existe -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Errores de validación si existen -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario de Edición -->
        <form action="{{ route('contratos.update', $contrato->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="mb-0">Información del Contrato</h5>
                </div>
                <div class="card-body">
                    <!-- NoLetras, InteresMoroso, Precio, etc. -->
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="NoLetras">Número de Letras (Pagos)</label>
                            <input type="number" name="NoLetras" class="form-control" value="{{ old('NoLetras', $contrato->NoLetras ?? '') }}">
                        </div>

                        <div class="col-md-6">
                            <label for="InteresMoroso">Interés Moroso</label>
                            <input type="number" step="0.1" name="InteresMoroso" class="form-control" value="{{ old('InteresMoroso', $contrato->InteresMoroso ?? '') }}">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="PrecioPredio">Precio del Predio</label>
                            <input type="text" id="PrecioPredio" name="PrecioPredio" class="form-control" value="{{ old('PrecioPredio', $contrato->PrecioPredio ?? '') }}" readonly>
                        </div>

                        <div class="col-md-6">
                            <label for="ConvenioTemporalidadPago">Convenio Temporalidad de Pago</label>
                            <input type="text" name="ConvenioTemporalidadPago" class="form-control" value="{{ old('ConvenioTemporalidadPago', $contrato->ConvenioTemporalidadPago ?? '') }}">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="observacion">Observaciones</label>
                            <textarea name="observacion" class="form-control">{{ old('observacion', $contrato->observacion ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Actualizar Contrato</button>
                <a href="{{ route('contratos.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@stop
