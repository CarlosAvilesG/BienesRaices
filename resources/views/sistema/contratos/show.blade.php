@extends('adminlte::page')

@section('title', 'Detalles del Contrato')

@section('content_header')
    <h1>Detalles del Contrato</h1>
@stop

@section('content')
    <div class="container">

          <!-- Botones pegajosos en la parte superior -->
          <div class="sticky-top bg-light py-2 mb-3">
            <div class="d-flex justify-content-end">
                <a href="{{ route('contratoPromesaPdf', $contrato->id) }}" class="btn btn-primary me-2">
                    <i class="fas fa-file-pdf"></i> Generar Contrato de Promesa de Venta
                </a>
                <a href="{{ route('contratos.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Regresar
                </a>
            </div>
        </div>

        <!-- Mensaje de éxito si existe -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Card: Información General del Contrato -->
        <div class="card card-primary mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-file-contract"></i> Información del Contrato</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="NoContrato" class="font-weight-bold">No. de Contrato:</label>
                        <p>{{ $contrato->NoContrato }}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="Cliente" class="font-weight-bold">Cliente:</label>
                        <p>{{ $contrato->cliente->nombre }} {{ $contrato->cliente->paterno }} {{ $contrato->cliente->materno }}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="FechaCelebracion" class="font-weight-bold">Fecha de Celebración:</label>
                        <p>{{ \Carbon\Carbon::parse($contrato->FechaCelebracion)->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card: Detalles del Lote -->
        <div class="card card-info mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> Detalles del Lote</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="Lote" class="font-weight-bold">Manzana y Lote:</label>
                        <p>Manzana: {{ $contrato->lote->manzana }}, Lote: {{ $contrato->lote->lote }}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="DescripcionLote" class="font-weight-bold">Descripción del Lote:</label>
                        <p>{{ $contrato->lote->descripcion }}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="PrecioPredio" class="font-weight-bold">Precio del Lote:</label>
                        <p id="PrecioPredio" data-value="{{ $contrato->PrecioPredio }}">${{ number_format($contrato->PrecioPredio, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card: Condiciones Financieras -->
        <div class="card card-success mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-money-bill-wave"></i> Condiciones Financieras</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="Enganche" class="font-weight-bold">Enganche:</label>
                        <p id="Enganche" data-value="{{ $contrato->Enganche }}">${{ number_format($contrato->Enganche, 2) }}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="Anualidades" class="font-weight-bold">Anualidades:</label>
                        <p id="Anualidades" data-value="{{ $contrato->Anualidades }}">{{ $contrato->Anualidades }}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="PagoAnualidad" class="font-weight-bold">Pago Anualidad:</label>
                        <p id="PagoAnualidad" data-value="{{ $contrato->PagoAnualidad }}">${{ number_format($contrato->PagoAnualidad, 2) }}</p>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <label for="NoLetras" class="font-weight-bold">Número de Letras (Pagos):</label>
                        <p id="NoLetras" data-value="{{ $contrato->NoLetras }}">{{ $contrato->NoLetras }}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="Mensualidad" class="font-weight-bold">Mensualidad:</label>
                        <p id="Mensualidad">${{ number_format($contrato->Mensualidad, 2) }}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="Quincenal" class="font-weight-bold">Pago Quincenal:</label>
                        <p id="Quincenal">${{ number_format($contrato->Quincenal, 2) }}</p>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <label for="TotalAnualidad" class="font-weight-bold">Total en Anualidad:</label>
                        <p id="TotalAnualidad">${{ number_format($contrato->TotalAnualidad, 2) }}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="TotalFinanciar" class="font-weight-bold">Total a Financiar:</label>
                        <p id="TotalFinanciar">${{ number_format($contrato->TotalFinanciar, 2) }}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="InteresMoroso" class="font-weight-bold">Interés Moratorio:</label>
                        <p>{{ $contrato->InteresMoroso }}%</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card: Observaciones -->
        <div class="card card-secondary mb-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0"><i class="fas fa-sticky-note"></i> Observaciones</h5>
            </div>
            <div class="card-body">
                <p>{{ $contrato->observacion ?: 'No hay observaciones.' }}</p>
            </div>
        </div>

        <!-- Botones de Acción -->
        {{-- <div class="d-flex justify-content-end">
            <!-- Botón para generar PDF del contrato de promesa de venta -->
            <a href="{{ route('contratoPromesaPdf', $contrato->id) }}" class="btn btn-primary me-2">
                <i class="fas fa-file-pdf"></i> Generar Contrato de Promesa de Venta
            </a>

            <!-- Botón para regresar al listado -->
            <a href="{{ route('contratos.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Regresar
            </a>
        </div> --}}
    </div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        // Calcular Mensualidad, Quincenalidad, Total en Anualidad y Total a Financiar
        function calcularValores() {
            // Obtener los valores relevantes
            const precioLote = parseFloat($('#PrecioPredio').data('value')) || 0; // Valor del precio del lote
            const pagoEnganche = parseFloat($('#Enganche').data('value')) || 0;  // Valor del enganche
            const pagoAnualidad = parseFloat($('#PagoAnualidad').data('value')) || 0; // Pago de anualidad
            const anualidades = parseInt($('#Anualidades').data('value')) || 0;  // Número de anualidades
            const numeroLetras = parseInt($('#NoLetras').data('value')) || 0;    // Número de letras (pagos)

            // Total en Anualidad
            const totalAnualidad = anualidades * pagoAnualidad;

            // Total a Financiar
            const totalFinanciar = (precioLote - pagoEnganche - totalAnualidad).toFixed(2);

            // Mensualidad
            let mensualidad = 0;
            if (numeroLetras > 0) {
                mensualidad = (totalFinanciar / numeroLetras).toFixed(2);
            }

            // Pago Quincenal (si es mensualidad, es la mitad)
            const pagoQuincenal = (mensualidad / 2).toFixed(2);

            // Mostrar los valores calculados en la página
            $('#Mensualidad').text(formatCurrency(mensualidad));
            $('#Quincenal').text(formatCurrency(pagoQuincenal));
            $('#TotalAnualidad').text(formatCurrency(totalAnualidad));
            $('#TotalFinanciar').text(formatCurrency(totalFinanciar));
        }

        // Función para dar formato a los valores en moneda
        function formatCurrency(value) {
            return parseFloat(value).toLocaleString('es-MX', {
                style: 'currency',
                currency: 'MXN'
            });
        }

        // Llamar a la función para calcular los valores inicialmente
        calcularValores();
    });
</script>
@stop
