@extends('adminlte::page')

@section('title', 'Corte de Caja')

@section('content_header')
<div class="row">
    <div class="col-md-10">
          <h1>Corte de Caja - {{ $usuario->name }} ({{ \Carbon\Carbon::parse($fechaInicio)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($fechaFin)->format('d/m/Y') }})</h1>
    </div>
    <div class="col-md-2">
        <form action="{{ route('corte_caja.cerrar_corte') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Cerrar Corte de Caja</button>
        </form>
    </div>
@stop

@section('content')

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
                        <th>Monto</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($egresos as $egreso)
                        <tr>
                            <td>{{ $egreso->id }}</td>
                            <td>{{ $egreso->concepto }}</td>
                            <td>${{ number_format($egreso->monto, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($egreso->created_at)->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop
