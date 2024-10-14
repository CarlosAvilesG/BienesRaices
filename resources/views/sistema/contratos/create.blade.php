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
                                    <option value="{{ $cliente->id }}">
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
                                    <option value="{{ $predio->id }}"> {{ $predio->nombre }}</option>
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
                            <input type="text" id="PrecioPredio" name="PrecioPredio" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <!-- Identificador del Contrato -->
                        <div class="col-md-6">
                            <label for="identificadorContrato">Identificador Contrato</label>
                            <input type="text" name="identificadorContrato" class="form-control" required>
                        </div>

                        <!-- No. de Contrato -->
                        <div class="col-md-6">
                            <label for="NoContrato">No. de Contrato</label>
                            <input type="text" name="NoContrato" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <!-- No. de Convenio -->
                        <div class="col-md-6">
                            <label for="NoConvenio" data-toggle="tooltip" data-original-title="Máximo 10 caracteres">No. de Convenio</label>
                            <input type="text" name="NoConvenio" class="form-control" maxlength="10">
                        </div>

                        <!-- Fecha de Celebración -->
                        <div class="col-md-3">
                            <label for="FechaCelebracion">Fecha de Celebración</label>
                            <input type="date" name="FechaCelebracion" class="form-control" required>
                        </div>

                            <!-- Hora de Celebración -->
                            <div class="col-md-3">
                                <label for="HoraCelebracion">Hora de Celebración</label>
                                <input type="time" name="HoraCelebracion" class="form-control" required>
                            </div>
                        
                    </div>



                    <!-- Sección de pagos -->
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="NoLetras" data-toggle="tooltip" data-original-title="Número de letras (pagos) original">Número de Letras (Pagos)</label>
                            <input type="number" name="NoLetras" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label for="InteresMoroso" data-toggle="tooltip" data-original-title="Interés moroso original (%)">Interés Moroso (%)</label>
                            <input type="number" name="InteresMoroso" class="form-control" step="0.1">
                        </div>
                    </div>

                    <!-- Sección de convenios -->
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="ConvenioTemporalidadPago" data-toggle="tooltip" data-original-title="Temporalidad original del convenio de pago">Convenio Temporalidad de Pago</label>
                            <input type="text" name="ConvenioTemporalidadPago" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label for="ConvenioViaPago" data-toggle="tooltip" data-original-title="Vía original del convenio de pago">Convenio Vía de Pago</label>
                            <input type="text" name="ConvenioViaPago" class="form-control">
                        </div>
                    </div>

                    <!-- Sección de observaciones -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="observacion">Observaciones</label>
                            <textarea name="observacion" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Crear Contrato</button>
                <a href="{{ route('contratos.index') }}" class="btn btn-secondary">Cancelar</a>
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

                                    $('#idLote').append('<option value="'+lote.id+'" data-precio="'+lote.precio+'" data-noletras="'+lote.NoLetras+'" data-interes="'+lote.InteresMoroso+'" data-temporalidad="'+lote.ConvenioTemporalidadPago+'" data-viapago="'+lote.ConvenioViaPago+'">Manzana: ' + lote.manzana + ', Lote: ' + lote.lote + ', Metros²: ' + lote.metrosCuadrados + ', Precio: '+ precioFormateado +'</option>');
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
                    // Limpiar campos relacionados
                    $('#PrecioPredio').val('');
                    $('[name="NoLetras"]').val('');
                    $('[name="InteresMoroso"]').val('');
                    $('[name="ConvenioTemporalidadPago"]').val('');
                    $('[name="ConvenioViaPago"]').val('');
                }
            });

            // Al cambiar el lote, actualizar campos
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
