@extends('adminlte::page')

@section('title', 'Corte de Caja')

@section('content_header')
<div class="row">
    {{-- <div class="col-md-10"> --}}
          <h1>Corte de Caja - {{ $usuario->name }} ({{ \Carbon\Carbon::parse($fechaInicio)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($fechaFin)->format('d/m/Y') }})</h1>
    {{-- </div> --}}

@stop

@section('content')


    <div class="row">
        <div class="col-md-9">
            <form action="{{ route('corte_caja.index') }}" method="GET" class="form-inline align-items-center">
                <label for="corte_id" class="mr-2 font-weight-bold">Histórico de cortes:</label>

                <select name="corte_id" id="corte_id" class="form-control mr-2" style="min-width: 280px;">
                    <option value="">🟢 Corte actual (no cerrado)</option>

                    @foreach ($cortes as $corte)
                        <option value="{{ $corte->id }}" {{ isset($corte_id) && $corte->id == $corte_id ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::parse($corte->fechaInicio)->format('d/m/Y H:i') }}
                            →
                            {{ \Carbon\Carbon::parse($corte->fechaFin)->format('d/m/Y H:i') }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-primary">Ver corte</button>
            </form>
        </div>
        <div class="col-md-3" style="text-align: center;">
            <form  id="formCerrarCorte"  action="{{ route('corte_caja.store') }}" method="POST" class="formCerrarCorte"  style="{{ !$esCorteActual ? 'display: none' : '' }}">
                @csrf
                <button type="submit" class="btn btn-success" data-toggle="tooltip" title="Cierra el corte actual">Cerrar Corte de Caja</button>

            </form>

            {{-- <a href="{{ route('corte_caja.imprimir', $corte_id ?? 0) }}"
                class="btn btn-info btn-sm {{ empty($corte_id) ? 'd-none' : '' }}"
                target="_blank">
                <i class="fas fa-print"></i> Imprimir
            </a> --}}
            <a href="{{ route('corte_caja.imprimir', $corte_id ?? 'actual') }}"
                class="btn btn-info btn-sm"
                target="_blank">
                <i class="fas fa-print"></i> Imprimir
            </a>

        </div>
    </div>

    </br>
    <div class="row">
        <div class="col-md-3">
            <x-adminlte-info-box title="Ingresos en Efectivo" text="${{ number_format($totalIngresosFisicos, 2) }}" icon="fas fa-cash-register text-success"/>
        </div>
        <div class="col-md-3">
            <x-adminlte-info-box title="Ingresos Transferencias" text="${{ number_format($totalIngresosTransferencia, 2) }}" icon="fas fa-university text-primary"/>
        </div>
        <div class="col-md-3">
            <x-adminlte-info-box title="Ingresos Cheque" text="${{ number_format($totalIngresosCheques, 2) }}" icon="fas fa-university text-primary"/>
        </div>
        <div class="col-md-3">
            <x-adminlte-info-box title="Total Egresos" text="${{ number_format($totalEgresos, 2) }}" icon="fas fa-money-bill-wave text-danger"/>
        </div>

    </div>

    <div class="card">
        <div class="card-header bg-success">
            <h3 class="card-title">Detalle de Ingresos</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        {{-- <th>IDUsu</th> --}}
                        <th>Folio</th>
                        <th>Cliente</th>
                        <th>Predio - Mzna - Lote</th>
                        <th>Tipo de Pago</th>
                        <th>Pago No.</th>
                        <th>Monto</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Nota</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ingresos as $ingreso)
                        <tr>
                            <td>{{ $ingreso->id }}</td>
                            {{-- <td>{{ $ingreso->idUsuario }}</td> --}}
                            <td>{{ $ingreso->folio }}</td>
                            <td>{{ $ingreso->cliente->nombreCompleto }}</td>
                            <td>{{ $ingreso->lote->Predio->nombre }} - {{ $ingreso->lote->manzana }} - {{ $ingreso->lote->lote }}</td>
                            <td>{{ $ingreso->tipoPago }} </td>
                            <td>{{ $ingreso->pagoNumero }} /{{ $ingreso->contrato->noLetras }}</td>
                            <td>${{ number_format($ingreso->monto, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($ingreso->fechaPago)->format('d/m/Y') }}</td>
                            <td>{{ $ingreso->horaPago }}</td>
                            <td>{{ $ingreso->observacion }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-danger">
            <h3 class="card-title">Detalle de Egresos</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Concepto</th>
                        <th>Persona que recibe</th>
                        <th>Monto</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($egresos as $egreso)
                        <tr>
                            <td>{{ $egreso->id }}</td>
                            <td>{{ $egreso->descripcion }}</td>
                            <td>{{ $egreso->usuarioRecibe->nombreCompleto }}</td>
                            <td>${{ number_format($egreso->monto, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($egreso->created_at)->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop


@section('css')
    {{-- Carga los estilos de AdminLTE y DataTables --}}
    <style>
        /* Efecto hover sobre la fila */
        #table1 tbody tr:hover {
            background-color: #f2f2f2;
            cursor: pointer;
        }

        /* Estilo del tooltip */
        [data-toggle="tooltip"] {
            position: relative;
        }
    </style>
@stop

@section('js')
    <script>
         document.addEventListener('DOMContentLoaded', function () {
            const corteSelect = document.getElementById('corte_id');
            const form = document.getElementById('formCerrarCorte');

        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Evitar el submit directo

            Swal.fire({
                title: '¿Estás seguro de cerrar el corte?',
                text: "Este proceso no se puede deshacer.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, cerrar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Enviar si confirma
                }
            });
        });

        corteSelect.addEventListener('change', function () {
        if (this.value === '') {
            // Si no selecciona ningún corte (es decir, el actual)
            formCerrar.style.display = 'inline';
        } else {
            // Si selecciona un corte anterior
            formCerrar.style.display = 'none';
        }
    });
    });
        // $(document).ready(function() {
        //     // Inicializar tooltips
        //     $('[data-toggle="tooltip"]').tooltip();

        //     // Confirmación de eliminación
        //     $('.formCerrarCorte').submit(function(e) {
        //         e.preventDefault();
        //         Swal.fire({
        //             title: '¿Estás seguro de cerrar el corte de caja?',
        //             text: "Después no podrás modificar este corte",
        //             icon: 'warning',
        //             showCancelButton: true,
        //             confirmButtonColor: '#3085d6',
        //             cancelButtonColor: '#d33',
        //             confirmButtonText: '¡Sí, realizar corte!',
        //             cancelButtonText: 'Cancelar'
        //         }).then((result) => {
        //             if (result.isConfirmed) {
        //                 this.submit();
        //             }
        //         })
        //     });
        // });
    </script>
@stop
