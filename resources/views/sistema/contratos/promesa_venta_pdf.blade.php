<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo de Pago</title>
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        .border-red {
            border: 2px solid #8B0000;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }
        .header-title {
            background-color: #8B0000;
            color: white;
            font-weight: bold;
            padding: 5px 10px;
            text-align: center;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }
        .logo img {
            width: 180px;
            display: block;
            margin: 0 auto;
        }
        .section-title {
            font-weight: bold;
            font-size: 16px;
            border-bottom: 2px solid #8B0000;
            margin-bottom: 5px;
        }
        .data-row {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
        }
        .data-row span {
            font-weight: bold;
        }
        .footer {
            text-align: center;
            font-weight: bold;
            margin-top: 10px;
        }
        .firma {
            text-align: right;
            font-weight: bold;
        }
        .qr-code {
            text-align: center;
            margin-top: 10px;
        }
        .small-text {
            font-size: 12px;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Recibo -->
        <div class="border-red">
            <div class="header-title">
                <div class="row">
                    <div class="col-6 text-left">
                        <strong>FECHA:</strong> {{ \Carbon\Carbon::parse($pago->fechaPago)->format('d/m/Y') }}
                    </div>
                    <div class="col-6 text-right">
                        <strong>FOLIO:</strong> N° {{ $pago->id }}
                    </div>
                </div>
            </div>

            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </div>

            <div class="data-row">
                <span>Cliente:</span> {{ $pago->cliente->nombre }} {{ $pago->cliente->paterno }} {{ $pago->cliente->materno }}
            </div>
            <div class="data-row">
                <span>Dirección:</span> {{ $pago->cliente->direccion }}
            </div>
            <div class="data-row">
                <span>Teléfono:</span> {{ $pago->cliente->telefonoCasa }} / Celular: {{ $pago->cliente->celular }}
            </div>

            <div class="section-title">Datos del Predio</div>
            <div class="data-row">
                <span>Predio:</span> {{ $pago->lote->predio->nombre }}
            </div>
            <div class="data-row">
                <span>Lote N°:</span> {{ $pago->lote->lote }} / Manzana N°: {{ $pago->lote->manzana }}
            </div>
            <div class="data-row">
                <span>Superficie:</span> {{ $pago->lote->metrosCuadrados }} m<sup>2</sup>
            </div>

            <div class="section-title">Datos del Pago</div>
            <div class="data-row">
                <span>Mensualidad No.:</span> {{ $pago->pagoNumero }} de {{ $pago->contrato->noLetras }}
            </div>
            <div class="data-row">
                <span>Monto:</span> ${{ number_format($pago->monto, 2) }} M.N.
            </div>
            <div class="data-row">
                <span>Motivo:</span> {{ $pago->motivo }}
            </div>
            <div class="data-row">
                <span>Referencia Bancaria:</span> {{ $pago->referenciaBancaria ?? 'N/A' }}
            </div>
            <div class="data-row">
                <span>Tipo de Pago:</span> {{ $pago->tipoPago }}
            </div>

            <div class="qr-code">
                <img src="data:image/png;base64,{{ base64_encode(QrCode::format('png')->size(100)->generate(route('pagos-lote.show', $pago->id))) }}" alt="QR Code">
            </div>

            <div class="footer">
                <p>Recibió: {{ $pago->usuario->name }}</p>
                <p>TEL: (612) 146 13 57</p>
                <hr class="small-text">
                <p class="small-text">COPIA CLIENTE</p>
            </div>
        </div>

    </div>

</body>
</html>
