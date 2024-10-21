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
            <!-- Botones pegajosos en la parte superior -->
            <div class="sticky-top bg-light py-2 mb-3">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Crear Contrato</button>
                    <a href="{{ route('contratos.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="mb-0">Información del Contrato</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Campo de cliente usando Select2 -->
                        <div class="col-md-6">
                            <label for="idCliente">Cliente</label>
                            <x-adminlte-select2 name="idCliente" class="select2 select2-primary"
                                data-dropdown-css-class="select2-primary" style="width: 100%;" required>
                                <option value="">Selecciona un cliente</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}"
                                        {{ old('idCliente') == $cliente->id ? 'selected' : '' }}>
                                        {{ $cliente->nombre }} {{ $cliente->paterno }} {{ $cliente->materno }}
                                        ({{ $cliente->celular }})
                                    </option>
                                @endforeach
                            </x-adminlte-select2>
                        </div>

                        <!-- Campo de predio usando Select2 -->
                        <div class="col-md-6">
                            <label for="idPredio">Predio</label>
                            <x-adminlte-select2 name="idPredio" id="idPredio" class="select2 select2-primary"
                                data-dropdown-css-class="select2-primary" style="width: 100%;" required>
                                <option value="">Selecciona un predio</option>
                                @foreach ($predios as $predio)
                                    <option value="{{ $predio->id }}"
                                        {{ old('idPredio') == $predio->id ? 'selected' : '' }}>
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
                            <x-adminlte-select2 name="idLote" id="idLote" class="select2 select2-primary"
                                data-dropdown-css-class="select2-primary" style="width: 100%;" required>
                                <option value="">Selecciona un predio primero</option>
                            </x-adminlte-select2>
                        </div>

                        <!-- Precio del predio -->
                        <div class="col-md-3">
                            <label for="precioPredio" data-toggle="tooltip"
                                data-original-title="Precio original del lote">Precio del Lote</label>
                            <input type="text" id="precioPredio" name="precioPredio" class="form-control"
                                value="{{ old('precioPredio') }}" readonly>
                        </div>

                        <div class="col-md-3">
                            <label for="enganche" data-toggle="tooltip" data-original-title="Pago de Enganche">Pago del
                                Enganche</label>
                            <input type="text" id="enganche" name="enganche" class="form-control"
                                value="{{ old('enganche') }}">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <!-- Identificador del Contrato -->
                        <div class="col-md-3">
                            <label for="identificadorContrato">Identificador Contrato</label>
                            <input type="text" name="identificadorContrato" class="form-control" required
                                value="{{ old('identificadorContrato') }}">
                        </div>

                        <!-- No. de Contrato -->
                        <div class="col-md-3">
                            <label for="noContrato">No. de Contrato</label>
                            <input type="text" name="noContrato" class="form-control" required
                                value="{{ old('noContrato') }}">
                        </div>
                        <!-- No. de Convenio -->
                        <div class="col-md-6">
                            <label for="noConvenio" data-toggle="tooltip" data-original-title="Máximo 10 caracteres">No. de
                                Convenio</label>
                            <input type="text" name="noConvenio" class="form-control" maxlength="10"
                                value="{{ old('noConvenio') }}">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <!-- Fecha de Celebración -->
                        <div class="col-md-3">
                            <label for="fechaCelebracion">Fecha de Celebración</label>
                            <input type="date" name="fechaCelebracion" id="fechaCelebracion" class="form-control"
                                required value="{{ old('fechaCelebracion') }}">
                        </div>

                        <!-- Hora de Celebración -->
                        <div class="col-md-3">
                            <label for="horaCelebracion">Hora de Celebración</label>
                            <input type="time" id="horaCelebracion" name="horaCelebracion" class="form-control" required
                                value="{{ old('horaCelebracion') }}">
                        </div>

                        <!-- Número de años -->
                        <div class="col-md-3">
                            <label for="noAnios" data-toggle="tooltip"
                                data-original-title="Número de años que dura el contrato">Años del Contrato</label>
                            <input type="number" step="1" name="noAnios" id="noAnios" class="form-control"
                                value="{{ old('noAnios') }}">
                        </div>

                        <!-- No. de Letras -->
                        <div class="col-md-3">
                            <label for="noLetras" data-toggle="tooltip"
                                data-original-title="Modificado: tabla: lotes, campo: plazoMeses">Número de Letras
                                (Pagos)</label>
                            <input type="number" name="noLetras" id="noLetras" class="form-control"
                                value="{{ old('noLetras') }}" readonly>
                        </div>



                    </div>



                    <!-- Sección de convenios -->
                    <div class="row mt-3">
                        <!-- Convenio Temporalidad Pago -->
                        <div class="col-md-3">
                            <label for="convenioTemporalidadPago" data-toggle="tooltip"
                                data-original-title="Opciones: quincenal, mensual">Temporalidad de Pago</label>
                            <select id="convenioTemporalidadPago" class="form-control" name="convenioTemporalidadPago">
                                <option value="">Selecciona una opción</option>
                                <option value="Quincenal"
                                    {{ old('convenioTemporalidadPago') == 'Quincenal' ? 'selected' : '' }}>Quincenal
                                </option>
                                <option value="Mensual"
                                    {{ old('convenioTemporalidadPago') == 'Mensual' ? 'selected' : '' }}>Mensual</option>
                            </select>
                        </div>

                        <!-- Convenio Vía de Pago -->
                        <div class="col-md-3">
                            <label for="convenioViaPago" data-toggle="tooltip"
                                data-original-title="Opciones: efectivo, bancaria, nómina">Convenio Vía de Pago</label>
                            <select class="form-control" id="convenioViaPago" name="convenioViaPago">
                                <option value="">Selecciona una opción</option>
                                <option value="Efectivo" {{ old('convenioViaPago') == 'Efectivo' ? 'selected' : '' }}>
                                    Efectivo</option>
                                <option value="Bancario" {{ old('convenioViaPago') == 'Bancario' ? 'selected' : '' }}>
                                    Bancario</option>
                                <option value="Nomina" {{ old('convenioViaPago') == 'Nomina' ? 'selected' : '' }}>Nomina
                                </option>
                            </select>
                        </div>
                        <!-- Anualidades -->
                        <div class="col-md-2">
                            <label for="anualidades" data-toggle="tooltip"
                                data-original-title="Número de anualidades">Anualidades</label>
                            <input type="number" id="anualidades" name="anualidades" step="1"
                                class="form-control" value="{{ old('anualidades', 0) }}">
                        </div>

                        <!-- Pago Anualidad -->
                        <div class="col-md-2">
                            <label for="pagoAnualidad" data-toggle="tooltip"
                                data-original-title="Si no hay Pagos Anuales poner cero, Si incluye no puede ser mayor a los Anios del Contrato">Pago
                                Anualidad</label>
                            <input type="number" step="1" id="pagoAnualidad" name="pagoAnualidad"
                                class="form-control" value="{{ old('pagoAnualidad') }}">
                        </div>
                        <!-- Interés Moroso -->
                        <div class="col-md-2">
                            <label for="interesMoroso" data-toggle="tooltip" data-original-title="Default: 10%">Interés
                                Moratorio (%)</label>
                            <input type="number" name="interesMoroso" id="interesMoroso" class="form-control"
                                step="0.1" value="10">
                        </div>
                    </div>
                    <!-- Sección de observaciones y Mostrar La mensualidad  -->
                    <div class="row mt-3 justify-content-center">
                        <div class="col-md-12">
                            <label for="observacion">Observaciones</label>
                            <textarea name="observacion" id="observacion" class="form-control" rows="3">{{ old('observacion') }}</textarea>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Sección de observaciones y Mostrar La mensualidad  -->
            <div class="card card-primary mt-3">
                <div class="card-header">
                    <h5 class="mb-0">Resumen de Calculos</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 d-flex flex-column align-items-center">
                            <label for="Mensualidad" data-toggle="tooltip"
                                data-original-title="Mensualidad">Mensualidad</label>
                            <label class="form-control" id="Mensualidad"
                                style="height: calc(1.5em + .75rem + 2px); width: 100%; text-align: center;">
                                {{ old('Mensualidad') }}
                            </label>
                        </div>
                        <div class="col-md-3 d-flex flex-column align-items-center">
                            <label for="Quincenal" data-toggle="tooltip"
                                data-original-title="Quincenal">Quincenal</label>
                            <label class="form-control" id="Quincenal"
                                style="height: calc(1.5em + .75rem + 2px); width: 100%; text-align: center;">
                                {{ old('Quincenal') }}
                            </label>
                        </div>

                        <!-- Total en Anualidad -->
                        <div class="col-md-3">
                            <label for="TotalAnualidad">Total Analuadad</label>
                            <input type="text" id="TotalAnualidad" name="TotalAnualidad" class="form-control"
                                value="{{ old('TotalAnualidad') }}" readonly>
                        </div>

                        <!-- Total a Financiar -->
                        <div class="col-md-3">

                            <label for="TotalFinanciar">Total a Financiar sin Anualidad</label>
                            <input type="text" id="TotalFinanciar" name="TotalFinanciar" class="form-control"
                                value="{{ old('TotalFinanciar') }}" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones de acción -->
            {{-- <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Crear Contrato</button>
                <a href="{{ route('contratos.index') }}" class="btn btn-secondary">Cancelar</a>
            </div> --}}
        </form>
    </div>
@stop

@section('js')
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip(); // Inicializar tooltips

            // Función para calcular el número de letras basado en años y temporalidad
            function updateNoLetras() {
                // Obtiene el valor de años
                const anios = parseInt($('#noAnios').val());
                // Obtiene el valor del select de temporalidad
                const temporalidad = $('#convenioTemporalidadPago').val();
                // Variable para almacenar el factor de la temporalidad
                let temporalidadFactor = 0;
                // Verifica el tipo de temporalidad seleccionada
                if (temporalidad === 'Mensual') {
                    temporalidadFactor = 12; // Mensual = 12 pagos al año
                } else if (temporalidad === 'Quincenal') {
                    temporalidadFactor = 24; // Quincenal = 24 pagos al año
                }
                // Verifica que los valores de anios y temporalidadFactor sean válidos
                if (!isNaN(anios) && anios > 0 && temporalidadFactor > 0) {
                    const noLetras = anios * temporalidadFactor;
                    // Establece el valor calculado en el campo NoLetras
                    $('#noLetras').val(noLetras);
                } else {
                    // Si los valores no son válidos, vacía el campo NoLetras
                    $('#noLetras').val('');
                }
            }

            // Escucha los eventos 'input' y 'change' en los campos involucrados
            $('#noAnios').on('input', updateNoLetras);
            $('#convenioTemporalidadPago').on('change', updateNoLetras); // Usar 'change' para selects

            // Función para calcular la mensualidad
            function calcularMensualidad() {
                const precioLote = parseFloat($('#precioPredio').val().replace(/[^0-9.-]+/g, "")) || 0;
                const pagoEnganche = parseFloat($('#enganche').val().replace(/[^0-9.-]+/g, "")) || 0;
                const pagoAnualidad = parseFloat($('#pagoAnualidad').val()) || 0;
                const anualidades = parseInt($('#anualidades').val()) || 0;
                const numeroLetras = parseInt($('#noLetras').val()) || 0;
                const anios = parseInt($('#noAnios').val()) || 0;
                const temporalidad = $('#convenioTemporalidadPago').val();

                // Verifica si los campos obligatorios están completos
                if (numeroLetras > 0 && precioLote > 0 && pagoEnganche >= 0) {
                    const montoRestante = (precioLote - pagoEnganche) - (pagoAnualidad * anualidades);

                    // Calcular la mensualidad y quincenalidad validando temporalidad del pago ConvenioTemporalidadPago

                    if (temporalidad === 'Mensual') {
                        const mensualidad = montoRestante / numeroLetras;
                        const Quincenal = mensualidad / 2;
                    } else if (temporalidad === 'Quincenal') {
                        const Quincenal = mensualidad / numeroLetras;
                        const mensualidad = Quincenal * 2;

                    }

                    const mensualidad = montoRestante / numeroLetras;
                    const Quincenal = mensualidad / 2;

                    // Mostrar el resultado en los campos de Mensualidad y Quincenal
                    if (mensualidad >= 0) {
                        $('#Mensualidad').text(mensualidad.toLocaleString('es-MX', {
                            style: 'currency',
                            currency: 'MXN'
                        }));
                        $('#Quincenal').text(Quincenal.toLocaleString('es-MX', {
                            style: 'currency',
                            currency: 'MXN'
                        }));
                    } else {
                        $('#Mensualidad').text('Monto no válido');
                        $('#Quincenal').text('');
                    }
                } else {
                    // Mostrar mensaje indicando que faltan datos
                    $('#Mensualidad').text('Faltan datos para calcular');
                    $('#Quincenal').text('');
                }
            }

            // Al cambiar cualquiera de los campos involucrados, recalcular la mensualidad
            $('#precioPredio, #enganche, #pagoAnualidad, #anualidades, #noLetras').on('input',
                calcularMensualidad);

            // Al cambiar predio, cargar lotes disponibles
            $('#idPredio').on('change', function() {
                var predioId = $(this).val();
                if (predioId) {
                    $.ajax({
                        url: '{{ route('lotes.byPredio') }}',
                        type: 'GET',
                        data: {
                            idPredio: predioId
                        },
                        success: function(data) {
                            $('#idLote').empty();

                            if (data.lotes && data.lotes.length > 0) {
                                $('#idLote').append(
                                    '<option value="">Selecciona un lote</option>');
                                $.each(data.lotes, function(index, lote) {
                                    var precioFormateado = parseFloat(lote.precio)
                                        .toLocaleString('es-MX', {
                                            style: 'currency',
                                            currency: 'MXN'
                                        });

                                    $('#idLote').append('<option value="' + lote.id +
                                        // '" data-precio="' + lote.precio +
                                        // '" data-noletras="' + lote.NoLetras +
                                        // '" data-interes="' + lote.InteresMoroso +
                                        // '" data-temporalidad="' + lote
                                        // .ConvenioTemporalidadPago +
                                        // '" data-viapago="' + lote.ConvenioViaPago +
                                        '">ManzanaX: ' + lote.manzana +
                                        ', LoteX: ' + lote.lote +
                                        ', DescripciónX: ' + lote.descripcion +
                                        //', Precio: ' +
                                        //precioFormateado +
                                        '</option>');
                                });
                            } else {
                                $('#idLote').append(
                                    '<option value="">No hay lotes disponibles</option>');
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                } else {
                    $('#idLote').empty().append('<option value="">Selecciona un predio primero</option>');
                }
            });

            // Al cambiar el lote, hacer la solicitud AJAX para obtener los datos
            $('#idLote').on('change', function() {
                var loteId = $(this).val(); // Obtener el id del lote seleccionado

                if (loteId) {
                    $.ajax({
                        url: '/lotes/' + loteId +
                            '/get', // Llamada a la ruta que devuelve los datos del lote
                        method: 'GET',
                        success: function(data) {
                            //  console.log('Datos del data:', data);
                            // Datos devueltos desde el servidor
                            var jsonlote =
                                data; //.lote; // Asegúrate de que en el backend envíes el lote en un formato JSON correcto

                            if (jsonlote) {
                                // Verificar los valores recibidos
                                //console.log('Datos del lote:', jsonlote);

                                // Actualizar PrecioPredio con el precio formateado
                                var precio = parseFloat(jsonlote.precio);
                                if (!isNaN(precio)) {
                                    $('#precioPredio').val(precio.toLocaleString('es-MX', {
                                        style: 'currency',
                                        currency: 'MXN'
                                    }));
                                } else {
                                    $('#precioPredio').val('');
                                }
                                // Actualizar el número de letras (plazoMeses)
                                $('#noLetras').val(jsonlote.plazoMeses || '');

                                // Actualizar el interés moratorio (fijo en 10 en este caso)
                                $('#interesMoroso').val('10');

                                // Calcular el número de años en base a los meses (plazoMeses)
                                var noAnios = jsonlote.plazoMeses / 12;
                                $('#noAnios').val(noAnios || '');

                                // Asignar el valor de temporalidad (Mensual fijo en este caso)
                                $('#convenioTemporalidadPago').val('Mensual');

                                // Crear variable FechaCelebracion con la fecha actual en formato yyyy-MM-dd
                                var FechaCelebracion = new Date();
                                var formattedDate = FechaCelebracion.toISOString().split('T')[
                                    0]; // yyyy-MM-dd
                                $('#fechaCelebracion').val(formattedDate);

                                // Crear variable HoraCelebracion con la hora actual en formato HH:mm
                                var HoraCelebracion = new Date();
                                var hours = HoraCelebracion.getHours().toString().padStart(2,
                                    '0'); // Formato HH
                                var minutes = HoraCelebracion.getMinutes().toString().padStart(
                                    2,
                                    '0'); // Formato mm
                                var formattedTime = hours + ':' + minutes; // HH:mm
                                $('#horaCelebracion').val(formattedTime);

                                // Recalcular la mensualidad
                                calcularMensualidad();
                            } else {
                                console.error('Lote no encontrado.');
                            }
                        },
                        error: function(xhr) {
                            console.error('Error al obtener datos del lote:', xhr.responseText);
                        }
                    });
                } else {
                    // Si no se selecciona un lote, puedes vaciar los campos si lo consideras necesario
                    $('#precioPredio').val('');
                    $('#noLetras').val('');
                    $('#interesMoroso').val('');
                    $('#noAnios').val('');
                    $('#convenioTemporalidadPago').val('');
                    $('#fechaCelebracion').val('');
                    $('#horaCelebracion').val('');
                }
            });

            // Al cambiar el número de anualidades, recalcular la mensualidad
            $(document).ready(function() {
                var oldPredio = '{{ old('idPredio') }}'; // Obtiene el valor anterior del predio
                var oldLote = '{{ old('idLote') }}'; // Obtiene el valor anterior del lote

                // Si hay un predio previamente seleccionado, carga los lotes
                if (oldPredio) {
                    cargarLotes(oldPredio, oldLote); // Pasamos también el lote anterior para seleccionarlo
                }

                // Al cambiar el predio, cargar los lotes disponibles
                $('#idPredio').on('change', function() {
                    var predioId = $(this).val();
                    cargarLotes(predioId, null); // Llamamos a la función sin un lote específico
                });

                // Función para cargar los lotes vía AJAX y seleccionar el lote anterior si existe
                function cargarLotes(predioId, loteSeleccionado) {
                    if (predioId) {
                        $.ajax({
                            url: '{{ route('lotes.byPredio') }}',
                            type: 'GET',
                            data: {
                                idPredio: predioId
                            },
                            success: function(data) {
                                $('#idLote')
                                    .empty(); // Vaciamos los lotes antes de cargar nuevos

                                if (data.lotes && data.lotes.length > 0) {
                                    $('#idLote').append(
                                        '<option value="">Selecciona un lote</option>');

                                    $.each(data.lotes, function(index, lote) {
                                        var selected = (lote.id == loteSeleccionado) ?
                                            'selected' :
                                            ''; // Seleccionar el lote anterior si coincide
                                        $('#idLote').append('<option value="' + lote
                                            .id + '" ' + selected + '>' +
                                            'Manzana: ' + lote.manzana +
                                            ', Lote: ' + lote.lote +
                                            ', Descripción: ' + lote.descripcion +
                                            '</option>');
                                    });
                                } else {
                                    $('#idLote').append(
                                        '<option value="">No hay lotes disponibles</option>'
                                    );
                                }
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    } else {
                        $('#idLote').empty().append(
                            '<option value="">Selecciona un predio primero</option>');
                    }
                }
            });

            $(document).ready(function() {
                // Escucha los cambios en los campos que afectan los cálculos
                $('#anualidades, #pagoAnualidad, #precioPredio, #enganche').on('input',
                    calcularTotalAnualidad);

                // Función para calcular total anualidad y total a financiar
                function calcularTotalAnualidad() {
                    // Obtener los valores de los campos relevantes
                    const anualidades = parseInt($('#anualidades').val()) || 0;
                    const pagoAnualidad = parseFloat($('#pagoAnualidad').val().replace(/[^0-9.-]+/g, "")) ||
                        0;
                    const precioLote = parseFloat($('#precioPredio').val().replace(/[^0-9.-]+/g, "")) || 0;
                    const pagoEnganche = parseFloat($('#enganche').val().replace(/[^0-9.-]+/g, "")) || 0;

                    // Calcular el total de anualidades
                    const totalAnualidad = anualidades * pagoAnualidad;

                    // Calcular el total a financiar restando el enganche y el total de anualidades al precio del lote
                    const TotalFinanciar = precioLote - pagoEnganche - totalAnualidad;

                    // validar si Anualidades es igual o menor a cero, pagoAnualidad pasarlos a 0
                    if (anualidades <= 0) {
                        $('#anualidades').val(0);
                        $('#pagoAnualidad').val(0);
                    }

                    // Mostrar los valores calculados en los campos de TotalAnualidad y TotalFinanciar
                    $('#TotalAnualidad').val(totalAnualidad.toLocaleString('es-MX', {
                        style: 'currency',
                        currency: 'MXN'
                    }));
                    $('#TotalFinanciar').val(TotalFinanciar.toLocaleString('es-MX', {
                        style: 'currency',
                        currency: 'MXN'
                    }));
                }

                // Llamar a la función para calcular los valores iniciales si ya hay valores en los campos
                calcularTotalAnualidad();
            });

            $(document).ready(function() {
                // Función para quitar las comas de un número y '$' antes de enviar el formulario
                function removeCommas(value) {
                    return value.replace(/[$,]/g, '');
                }



                // Al enviar el formulario, eliminar las comas del campo Enganche
                $('form').on('submit', function() {
                    var enganche = $('#enganche').val();
                    $('#Enganche').val(removeCommas(enganche)); // Elimina las comas antes de enviar
                });

            });


        });
    </script>
@stop
