<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Impresión Corte de Caja</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #333;
            position: relative;
        }

        h1, h2, h3 {
            text-align: center;
        }

        .info-boxes {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .box {
            flex: 1;
            margin: 0 10px;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            background-color: #f8f9fa;
            box-shadow: 0 0 5px rgba(0,0,0,0.05);
            text-align: center;
        }

        .box i {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .green { color: #28a745; }
        .blue { color: #007bff; }
        .red { color: #dc3545; }

        .section-title {
            background: #e9ecef;
            padding: 8px;
            font-weight: bold;
            margin-top: 30px;
            border-left: 5px solid #3c8dbc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 11px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f1f1f1;
        }

        .watermark {
            position: fixed;
            top: 40%;
            left: 20%;
            font-size: 5rem;
            color: rgba(200, 200, 200, 0.2);
            transform: rotate(-30deg);
            z-index: 0;
            pointer-events: none;
            user-select: none;
        }

        .footer {
            position: fixed;
            bottom: 40px;
            left: 20px;
            right: 20px;
            font-size: 11px;
            color: #666;
            display: flex;
            justify-content: space-between;
        }

        .signature-block {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            text-align: center;
        }

        .signature {
            width: 45%;
        }

        .signature .line {
            border-top: 1px solid #000;
            margin-top: 60px;
        }

        @media print {
            .footer {
                position: fixed;
                bottom: 20px;
            }

            @page {
                margin: 20mm;
            }
        }
    </style>
</head>
<body>
    @if ($esPreliminar)
        <div class="watermark">PRELIMINAR</div>
    @endif

    <h1>Corte de Caja</h1>

    <p><strong>Usuario:</strong> {{ $usuario->name }}</p>
    <p><strong>Periodo:</strong> {{ \Carbon\Carbon::parse($fechaInicio)->format('d/m/Y H:i') }} - {{ \Carbon\Carbon::parse($fechaFin)->format('d/m/Y H:i') }}</p>

    {{-- RESUMEN DE MONTOS --}}
    <div class="info-boxes">
        <div class="box green">
            <i class="fas fa-cash-register"></i>
            Ingresos en Efectivo
            <div><strong>${{ number_format($totalIngresosFisicos, 2) }}</strong></div>
        </div>
        <div class="box blue">
            <i class="fas fa-university"></i>
            Ingresos Transferencias
            <div><strong>${{ number_format($totalIngresosTransferencia, 2) }}</strong></div>
        </div>
        <div class="box blue">
            <i class="fas fa-university"></i>
            Ingresos Cheque
            <div><strong>${{ number_format($totalIngresosCheques, 2) }}</strong></div>
        </div>
        <div class="box red">
            <i class="fas fa-money-bill-wave"></i>
            Total Egresos
            <div><strong>${{ number_format($totalEgresos, 2) }}</strong></div>
        </div>
    </div>

    {{-- DETALLES: EFECTIVO --}}
    <div class="section-title">Detalle de Ingresos en Efectivo</div>
    <table>
        <thead>
            <tr>
                <th>Predio</th>
                <th>Mzna/Lote</th>
                <th>Contrato</th>
                <th>Cliente</th>
                <th>Motivo</th>
                <th>Tipo Pago</th>
                <th>Monto</th>
                <th>Fecha/Hora</th>
                <th>Observación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detalles->where('tipoMovimiento', 'Ingreso')->where('pagoLote.tipoPago', 'Efectivo') as $detalle)
                <tr>
                    <td>{{ $detalle->pagoLote->predio->nombre }}</td>
                    <td>{{ $detalle->pagoLote->lote->manzana }} / {{ $detalle->pagoLote->lote->lote }}</td>
                    <td>{{ $detalle->pagoLote->contrato->identificadorContrato }}</td>
                    <td>{{ $detalle->pagoLote->cliente->nombreCompleto }}</td>
                    <td>{{ $detalle->pagoLote->motivo }}</td>
                    <td>{{ $detalle->pagoLote->tipoPago }}</td>
                    <td>${{ number_format($detalle->monto, 2) }}</td>
                    <td>{{ $detalle->pagoLote->fechaPago }} - {{ $detalle->pagoLote->horaPago }}</td>
                    <td>{{ $detalle->pagoLote->observacion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- DETALLES: BANCARIO --}}
    <div class="section-title">Detalle de Ingresos Bancarios</div>
    <table>
        <thead>
            <tr>
                <th>Predio</th>
                <th>Mzna/Lote</th>
                <th>Contrato</th>
                <th>Cliente</th>
                <th>Motivo</th>
                <th>Tipo Pago</th>
                <th>Referencia</th>
                <th>Monto</th>
                <th>Fecha/Hora</th>
                <th>Observación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detalles->where('tipoMovimiento', 'Ingreso')->whereIn('pagoLote.tipoPago', ['Transferencia', 'Cheque']) as $detalle)
                <tr>
                    <td>{{ $detalle->pagoLote->predio->nombre }}</td>
                    <td>{{ $detalle->pagoLote->lote->manzana }} / {{ $detalle->pagoLote->lote->lote }}</td>
                    <td>{{ $detalle->pagoLote->contrato->identificadorContrato }}</td>
                    <td>{{ $detalle->pagoLote->cliente->nombreCompleto }}</td>
                    <td>{{ $detalle->pagoLote->motivo }}</td>
                    <td>{{ $detalle->pagoLote->tipoPago }}</td>
                    <td>{{ $detalle->pagoLote->referenciaBancaria }}</td>
                    <td>${{ number_format($detalle->monto, 2) }}</td>
                    <td>{{ $detalle->pagoLote->fechaPago }} - {{ $detalle->pagoLote->horaPago }}</td>
                    <td>{{ $detalle->pagoLote->observacion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- DETALLES: EGRESOS --}}
    <div class="section-title">Detalle de Egresos</div>
    <table>
        <thead>
            <tr>
                <th>Recibe</th>
                <th>Concepto</th>
                <th>Monto</th>
                <th>Fecha</th>
                <th>Cancelado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detalles->where('tipoMovimiento', 'Egreso') as $detalle)
                <tr>
                    <td>{{ $detalle->egreso->usuarioRecibe->nombreCompleto ?? '---' }}</td>
                    <td>{{ $detalle->egreso->concepto ?? '---' }}</td>
                    <td>${{ number_format($detalle->egreso->monto ?? 0, 2) }}</td>
                    <td>{{ $detalle->egreso->created_at->format('d/m/Y') ?? '---' }}</td>
                    <td>{{ $detalle->egreso->Cancelado ? 'Sí' : 'No' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- FIRMAS --}}
    <div class="signature-block">
        <div class="signature">
            <div class="line"></div>
            <div>{{ $usuario->name }} <br><strong>Firma del Operador</strong></div>
        </div>

        <div class="signature">
            <div class="line"></div>
            <div>________________________ <br><strong>Firma del Receptor</strong></div>
        </div>
    </div>

    {{-- PIE DE PÁGINA --}}
    <div class="footer">
        <div>Fecha de impresión: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</div>
        <div class="page-number">Página <span class="pageNumber"></span> de <span class="totalPages"></span></div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        window.onload = function() {
            window.print();
        };

        // Si usas JS para imprimir número de páginas (solo para PDF plugin o impresión directa)
        window.addEventListener('afterprint', () => {
            document.querySelector('.page-number').style.display = 'none';
        });
    </script>
</body>
</html>


{{-- @extends('adminlte::page')

@section('title', 'Impresión Corte de Caja')

@section('content')
<div class="watermark-container">
    @if ($esPreliminar)
        <div class="watermark">PRELIMINAR</div>
    @endif

    <h2>Corte de Caja - {{ $usuario->name }}</h2>
    <p>Periodo: {{ $fechaInicio }} a {{ $fechaFin }}</p>


    <div class="row">
        <div class="col">Efectivo: ${{ number_format($totalIngresosFisicos, 2) }}</div>
        <div class="col">Transferencias: ${{ number_format($totalIngresosTransferencia, 2) }}</div>
        <div class="col">Cheques: ${{ number_format($totalIngresosCheques, 2) }}</div>
        <div class="col">Egresos: ${{ number_format($totalEgresos, 2) }}</div>
    </div>

    <hr>


    <h4>Movimientos</h4>
    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Predio</th>
                <th>Cliente</th>
                <th>Contrato</th>
                <th>Tipo Pago</th>
                <th>Monto</th>
                <th>Fecha</th>
                <th>Hora</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detalles as $detalle)
                <tr>
                    <td>{{ $detalle->tipoMovimiento }}</td>
                    <td>{{ optional($detalle->pagoLote->lote->predio)->nombre ?? '-' }}</td>
                    <td>{{ optional($detalle->pagoLote->cliente)->nombreCompleto ?? '-' }}</td>
                    <td>{{ optional($detalle->pagoLote->contrato)->noContrato ?? '-' }}</td>
                    <td>{{ $detalle->pagoLote->tipoPago ?? '-' }}</td>
                    <td>${{ number_format($detalle->monto, 2) }}</td>
                    <td>{{ optional($detalle->pagoLote)->fechaPago ?? '-' }}</td>
                    <td>{{ optional($detalle->pagoLote)->horaPago ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop

@section('css')
<style>
    .watermark-container {
        position: relative;
    }

    .watermark {
        position: absolute;
        top: 40%;
        left: 25%;
        font-size: 6rem;
        color: rgba(200, 200, 200, 0.2);
        transform: rotate(-30deg);
        z-index: 0;
        pointer-events: none;
        user-select: none;
    }
</style>
@stop --}}


{{-- <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Imprimir Corte de Caja</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; }
        h1, h2 { text-align: center; margin-bottom: 10px; }
        .info-boxes { display: flex; gap: 20px; margin: 20px 0; justify-content: center; }
        .box {
            flex: 1;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        .box i { font-size: 20px; display: block; margin-bottom: 5px; }
        .green { color: green; }
        .blue { color: blue; }
        .red { color: red; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #999;
            padding: 6px;
            font-size: 11px;
            text-align: left;
        }
        th {
            background: #f0f0f0;
        }

        .section-title {
            background-color: #e9e9e9;
            padding: 8px;
            margin-top: 30px;
            font-size: 14px;
            font-weight: bold;
            border-left: 5px solid #3c8dbc;
        }

        .totales {
            margin-top: 30px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h1>Corte de Caja</h1>

    <p><strong>Usuario:</strong> {{ $usuario->name }}</p>
    <p><strong>Fecha del Corte:</strong> {{ \Carbon\Carbon::parse($fechaInicio)->format('d/m/Y H:i') }} - {{ \Carbon\Carbon::parse($fechaFin)->format('d/m/Y H:i') }}</p>

    <div class="info-boxes">
        <div class="box">
            <i class="fas fa-cash-register green"></i>
            <div>Ingresos en Efectivo</div>
            <strong>${{ number_format($totalIngresosFisicos, 2) }}</strong>
        </div>
        <div class="box">
            <i class="fas fa-university blue"></i>
            <div>Ingresos Transferencias</div>
            <strong>${{ number_format($totalIngresosTransferencia, 2) }}</strong>
        </div>
        <div class="box">
            <i class="fas fa-university blue"></i>
            <div>Ingresos Cheque</div>
            <strong>${{ number_format($totalIngresosCheques, 2) }}</strong>
        </div>
        <div class="box">
            <i class="fas fa-money-bill-wave red"></i>
            <div>Total Egresos</div>
            <strong>${{ number_format($totalEgresos, 2) }}</strong>
        </div>
    </div>

    INGRESOS EFECTIVO
    <div class="section-title">Detalle de Ingresos en Efectivo</div>
    <table>
        <thead>
            <tr>
                <th>Predio</th>
                <th>Mzna/Lote</th>
                <th>Contrato</th>
                <th>Cliente</th>
                <th>Motivo</th>
                <th>Tipo Pago</th>
                <th>Monto</th>
                <th>Fecha/Hora</th>

                <th>Observación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detalles->where('tipoMovimiento', 'Ingreso')->where('pagoLote.tipoPago', 'Efectivo') as $detalle)
                <tr>
                    <td>{{ $detalle->pagoLote->predio->nombre }}</td>
                    <td>{{ $detalle->pagoLote->lote->manzana }} / {{ $detalle->pagoLote->lote->lote }}</td>
                    <td>{{ $detalle->pagoLote->contrato->identificadorContrato }}</td>
                    <td>{{ $detalle->pagoLote->cliente->nombreCompleto }}</td>
                    <td>{{ $detalle->pagoLote->motivo }}</td>
                    <td>{{ $detalle->pagoLote->tipoPago }}</td>
                    <td>${{ number_format($detalle->pagoLote->monto, 2) }}</td>
                    <td>{{ $detalle->pagoLote->fechaPago }} - {{ $detalle->pagoLote->horaPago }}</td>

                    <td>{{ $detalle->pagoLote->observacion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <div class="section-title">Detalle de Ingresos Bancarios</div>
    <table>
        <thead>
            <tr>
                <th>Predio</th>
                <th>Mzna/Lote</th>
                <th>Contrato</th>
                <th>Cliente</th>
                <th>Motivo</th>
                <th>Tipo Pago</th>
                <th>Referencia</th>
                <th>Monto</th>
                <th>Fecha/Hora</th>

                <th>Observación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detalles->where('tipoMovimiento', 'Ingreso')->whereIn('pagoLote.tipoPago', ['Transferencia', 'Cheque']) as $detalle)
                <tr>
                    <td>{{ $detalle->pagoLote->predio->nombre }}</td>
                    <td>{{ $detalle->pagoLote->lote->manzana }} / {{ $detalle->pagoLote->lote->lote }}</td>
                    <td>{{ $detalle->pagoLote->contrato->identificadorContrato }}</td>
                    <td>{{ $detalle->pagoLote->cliente->nombreCompleto }}</td>
                    <td>{{ $detalle->pagoLote->motivo }}</td>
                    <td>{{ $detalle->pagoLote->tipoPago }}</td>
                    <td>{{ $detalle->pagoLote->referenciaBancaria }}</td>
                    <td>${{ number_format($detalle->pagoLote->monto, 2) }}</td>
                    <td>{{ $detalle->pagoLote->fechaPago }} - {{ $detalle->pagoLote->horaPago }}</td>

                    <td>{{ $detalle->pagoLote->observacion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <div class="section-title">Detalle de Egresos</div>
    <table>
        <thead>
            <tr>
                <th>Recibe</th>
                <th>Concepto</th>
                <th>Monto</th>
                <th>Fecha</th>
                <th>Cancelado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detalles->where('tipoMovimiento', 'Egreso') as $detalle)
                <tr>
                    <td>{{ $detalle->egreso->usuarioRecibe->nombreCompleto ?? '---' }}</td>
                    <td>{{ $detalle->egreso->concepto ?? '---' }}</td>
                    <td>${{ number_format($detalle->egreso->monto ?? 0, 2) }}</td>
                    <td>{{ $detalle->egreso->created_at->format('d/m/Y') ?? '---' }}</td>
                    <td>{{ $detalle->egreso->Cancelado ?? '---' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html> --}}
