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
                                        {{ $predio->nombre }}
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
                </div>
            </div>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">{{ isset($contrato) ? 'Actualizar Contrato' : 'Crear Contrato' }}</button>
                <a href="{{ route('contratos.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>

        </form>

    </div>
@stop

@section('js')
    <!-- Inicialización de Select2 -->
    <script>
        $(document).ready(function() {
            // Inicializar Select2
            $('.select2').select2({
                theme: 'bootstrap4',
                placeholder: "Selecciona una opción",
                allowClear: true
            });

            // Cargar lotes cuando se selecciona un predio
            $('#idPredio').on('change', function() {
                var predioId = $(this).val();
                if (predioId) {
                    $.ajax({
                        url: '{{ route("lotes.byPredio") }}',  // Ruta a tu controlador
                        type: 'GET',
                        data: { idPredio: predioId },
                        success: function(data) {
                            $('#idLote').empty();
                            $.each(data.lotes, function(index, lote) {
                                $('#idLote').append('<option value="'+lote.id+'" data-precio="'+lote.precio+'">'+
                                    'Manzana: ' + lote.manzana + ', Lote: ' + lote.lote + ', Descripción: ' + lote.descripcion +
                                    '</option>');
                            });
                            $('#idLote').trigger('change');
                        }
                    });
                } else {
                    $('#idLote').empty().append('<option value="">Selecciona un predio primero</option>');
                }
            });

            // Al cambiar lote, actualizar el precio
            $('#idLote').on('change', function() {
                var selectedOption = $(this).find('option:selected');
                var precio = selectedOption.data('precio');
                $('#PrecioPredio').val(precio ? precio.toLocaleString('es-MX', { style: 'currency', currency: 'MXN' }) : '');
            });
        });
    </script>
@stop
