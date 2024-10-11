@extends('adminlte::page')

@section('plugins.Select2', true)

@section('title', isset($contrato) ? 'Editar Contrato' : 'Crear Contrato')

@section('content_header')
    <h1>{{ isset($contrato) ? 'Editar Contrato' : 'Crear Contrato' }}</h1>
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

        <!-- Formulario -->
        <form action="{{ isset($contrato) ? route('contratos.update', $contrato->id) : route('contratos.store') }}" method="POST">
            @csrf
            @if (isset($contrato))
                @method('PUT')
            @endif

            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="mb-0">Información del Contrato</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Campo de cliente usando Select2 -->
                        <div class="col-md-6">
                            <label for="idCliente">Cliente</label>
                            <x-adminlte-select2 name="idCliente" class="select2 select2-primary" data-dropdown-css-class="select2-primary" style="width: 100%;" required>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" {{ isset($contrato) && $contrato->idCliente == $cliente->id ? 'selected' : '' }}>
                                        {{ $cliente->nombre }} {{ $cliente->paterno }} {{ $cliente->materno }} ({{ $cliente->celular }})
                                    </option>
                                @endforeach
                            </x-adminlte-select2>
                        </div>

                        <!-- Campo de predio usando Select2 -->
                        <div class="col-md-6">
                            <label for="idPredio">Predio</label>
                            <x-adminlte-select2 name="idPredio" id="idPredio" class="select2 select2-primary" data-dropdown-css-class="select2-primary" style="width: 100%;" required>
                                @foreach($predios as $predio)
                                    <option value="{{ $predio->id }}" {{ isset($contrato) && $contrato->idPredio == $predio->id ? 'selected' : '' }}>
                                        {{ $predio->nombre }} - {{ $predio->descripcion }}
                                    </option>
                                @endforeach
                            </x-adminlte-select2>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <!-- Campo de lote usando Select2 con tooltip -->
                        <div class="col-md-6">
                            <label for="idLote">Lote</label>
                            <x-adminlte-select2 name="idLote" id="idLote" class="select2 select2-primary" data-dropdown-css-class="select2-primary" style="width: 100%;" required>
                                <option value="">Selecciona un predio primero</option>
                            </x-adminlte-select2>
                        </div>

                        <div class="col-md-6">
                            <label for="PrecioPredio">Precio del Predio</label>
                            <input type="text" id="PrecioPredio" name="PrecioPredio" class="form-control" value="{{ old('PrecioPredio', $contrato->PrecioPredio ?? '') }}" readonly>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="NoContrato">No. de Contrato</label>
                            <input type="text" name="NoContrato" class="form-control" value="{{ old('NoContrato', $contrato->NoContrato ?? '') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="NoConvenio">No. de Convenio</label>
                            <input type="text" name="NoConvenio" class="form-control" value="{{ old('NoConvenio', $contrato->NoConvenio ?? '') }}">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="FechaCelebracion">Fecha de Celebración</label>
                            <input type="date" name="FechaCelebracion" class="form-control" value="{{ old('FechaCelebracion', $contrato->FechaCelebracion ?? '') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="HoraCelebracion">Hora de Celebración</label>
                            <input type="time" name="HoraCelebracion" class="form-control" value="{{ old('HoraCelebracion', $contrato->HoraCelebracion ?? '') }}" required>
                        </div>
                    </div>

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
                        <div class="col-md-12">
                            <label for="observacion">Observaciones</label>
                            <textarea name="observacion" class="form-control">{{ old('observacion', $contrato->observacion ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">{{ isset($contrato) ? 'Actualizar Contrato' : 'Crear Contrato' }}</button>
                <a href="{{ route('contratos.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>

        </form>

    </div>
@stop

@section('css')
    <!-- Incluir CSS de Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap4-theme/1.0.0/select2-bootstrap4.min.css" rel="stylesheet" />
@stop

@section('js')
    <!-- Incluir JS de Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- Script para manejar el cambio de predio y cargar lotes -->
    <script>
        $(document).ready(function() {
            // Inicializar Select2
            $('.select2').select2({
                theme: 'bootstrap4',
                placeholder: "Selecciona una opción",
                allowClear: true
            });

            // Al seleccionar un predio, cargar los lotes correspondientes
            $('#idPredio').on('change', function() {
                var predioId = $(this).val();
                if (predioId) {
                    $.ajax({
                        url: '{{ route("lotes.byPredio") }}', // Ruta para obtener los lotes por predio
                        type: 'GET',
                        data: { idPredio: predioId },
                        success: function(data) {
                            $('#idLote').empty();
                            $.each(data.lotes, function(index, lote) {
                                $('#idLote').append('<option value="'+lote.id+'" data-precio="'+lote.precio+'">'+
                                    'Manzana: ' + lote.manzana + ', Lote: ' + lote.lote + ', Descripción: ' + lote.descripcion +
                                    '</option>');
                            });
                            $('#idLote').trigger('change'); // Forzar actualización de Select2
                        }
                    });
                } else {
                    $('#idLote').empty().append('<option value="">Selecciona un predio primero</option>');
                }
            });

            // Al cambiar el lote, actualizar el precio
            $('#idLote').on('change', function() {
                var selectedOption = $(this).find('option:selected');
                var precio = selectedOption.data('precio'); // Obtener el precio del lote
                if (precio) {
                    $('#PrecioPredio').val(precio.toLocaleString('es-MX', { style: 'currency', currency: 'MXN' }));
                } else {
                    $('#PrecioPredio').val('');
                }
            });
        });
    </script>
@stop
