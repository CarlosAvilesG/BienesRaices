@extends('adminlte::page')

@section('plugins.Select2', true)

@section('title', 'Crear Contrato')

@section('content_header')
    <h1>Crear Contrato</h1>
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

        <!-- Formulario de Creación -->
        <form action="{{ route('contratos.store') }}" method="POST">
            @csrf

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
                                <option value="">Selecciona un cliente</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" {{ old('idCliente') == $cliente->id ? 'selected' : '' }}>
                                        {{ $cliente->nombre }} {{ $cliente->paterno }} {{ $cliente->materno }} ({{ $cliente->celular }})
                                    </option>
                                @endforeach
                            </x-adminlte-select2>
                        </div>

                        <!-- Campo de predio usando Select2 -->
                        <div class="col-md-6">
                            <label for="idPredio">Predio</label>
                            <x-adminlte-select2 name="idPredio" id="idPredio" class="select2 select2-primary" data-dropdown-css-class="select2-primary" style="width: 100%;" required>
                                <option value="">Selecciona un predio</option>
                                @foreach($predios as $predio)
                                    <option value="{{ $predio->id }}" {{ old('idPredio') == $predio->id ? 'selected' : '' }}>
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

                        <!-- Precio del predio -->
                        <div class="col-md-6">
                            <label for="PrecioPredio" data-toggle="tooltip" data-original-title="Precio original del lote">Precio del Predio</label>
                            <input type="text" id="PrecioPredio" name="PrecioPredio" class="form-control" readonly value="{{ old('PrecioPredio') }}">
                        </div>
                    </div>

                    <!-- Otros campos... -->
                    <!-- Aquí puedes agregar los otros campos del formulario -->

                    <!-- Botones de acción -->
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Crear Contrato</button>
                        <a href="{{ route('contratos.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

@section('js')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip(); // Inicializar tooltips

            // Al cambiar predio, cargar lotes disponibles
            $('#idPredio').on('change', function() {
                var predioId = $(this).val();
                cargarLotes(predioId);
            });

            // Función para cargar los lotes
            function cargarLotes(predioId, selectedLoteId = null) {
                if (predioId) {
                    $.ajax({
                        url: '{{ route("lotes.byPredio") }}',
                        type: 'GET',
                        data: { idPredio: predioId },
                        success: function(data) {
                            $('#idLote').empty(); // Limpiar el combo box antes de agregar nuevas opciones

                            if (data.lotes && data.lotes.length > 0) {
                                $('#idLote').append('<option value="">Selecciona un lote</option>');
                                $.each(data.lotes, function(index, lote) {
                                    var precioFormateado = parseFloat(lote.precio).toLocaleString('es-MX', { style: 'currency', currency: 'MXN' });
                                    var selected = (lote.id == selectedLoteId) ? 'selected' : '';
                                    $('#idLote').append('<option value="'+lote.id+'" '+selected+' data-precio="'+lote.precio+'" data-noletras="'+lote.NoLetras+'" data-interes="'+lote.InteresMoroso+'" data-temporalidad="'+lote.ConvenioTemporalidadPago+'" data-viapago="'+lote.ConvenioViaPago+'">Manzana: ' + lote.manzana + ', Lote: ' + lote.lote + ', Metros²: ' + lote.metrosCuadrados + ', Precio: '+ precioFormateado +'</option>');
                                });
                            } else {
                                $('#idLote').append('<option value="">No hay lotes disponibles</option>');
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                } else {
                    $('#idLote').empty().append('<option value="">Selecciona un predio primero</option>');
                }
            }

            // Cargar lotes automáticamente si ya hay un predio seleccionado (en caso de errores de validación)
            var predioSeleccionado = '{{ old('idPredio') }}';
            var loteSeleccionado = '{{ old('idLote') }}';

            if (predioSeleccionado) {
                cargarLotes(predioSeleccionado, loteSeleccionado);
            }

            // Al cambiar el lote, actualizar campos relacionados
            $('#idLote').on('change', function() {
                var selectedOption = $(this).find('option:selected');
                var precio = selectedOption.data('precio');
                var noLetras = selectedOption.data('noletras');
                var interes = selectedOption.data('interes');
                var temporalidad = selectedOption.data('temporalidad');
                var viaPago = selectedOption.data('viapago');

                $('#PrecioPredio').val(precio ? parseFloat(precio).toLocaleString('es-MX', { style: 'currency', currency: 'MXN' }) : '');
                $('[name="NoLetras"]').val(noLetras || '');
                $('[name="InteresMoroso"]').val(interes || '');
                $('[name="ConvenioTemporalidadPago"]').val(temporalidad || '');
                $('[name="ConvenioViaPago"]').val(viaPago || '');
            });
        });
    </script>
@stop
