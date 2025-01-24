<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo de Pago</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            border: 1px solid #000;
            padding: 20px;
            max-width: 800px;
        }
        .header {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .sub-header {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .content {
            font-size: 14px;
        }
        .content p {
            margin: 5px 0;
        }
        .amount {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
        }
        .footer {
            margin-top: 40px;
            font-size: 12px;
            text-align: center;
        }
        .line {
            border-top: 1px dashed #000;
            margin: 20px 0;
        }
    </style>
</head>
<body>

    <div class="header">
        OFICINA: BOULEVARD LUIS DONALDO COLOSIO NO.1835, <br>
        UNIDAD DONCELES 28, C.P. 23078 - LA PAZ, BCS, MEXICO
    </div>

    <div class="sub-header">
        RECIBO DE PAGO - {{ date('d/m/Y') }} {{ date('H:i') }}
    </div>

    <div class="content">
        <p><strong>Predio:</strong> {{ $pago->lote->predio->nombre }}</p>
        <p><strong>Manzana:</strong> {{ $pago->manzana }}</p>
        <p><strong>Lote:</strong> {{ $pago->lote }}</p>
        <p><strong>Cliente:</strong> {{ $pago->cliente->nombre_completo }} </p>
        <p><strong>Celular:</strong> {{ $pago->cliente->celular }}</p>
        <p><strong>Referencia Bancaria:</strong> {{ $pago->referenciaBancaria ?? 'N/A' }}</p>
        <p><strong>Motivo:</strong> {{ $pago->motivo }}</p>
        <p><strong>Tipo de Pago:</strong> {{ $pago->tipoPago }}</p>
        <p><strong>No. de Pago:</strong> {{ $pago->pagoNumero }}</p>
    </div>

    <div class="amount">
        <p>LA CANTIDAD DE: <strong>${{ number_format($pago->monto, 2) }}</strong></p>
        <p>({{ \App\Helpers\GeneralHelper::convertirNumeroALetras($pago->monto) }})</p>
    </div>

    <div class="content">
        <p><strong>Recibió:</strong> {{ $pago->usuario->nombre }} {{ $pago->usuario->paterno }}</p>
    </div>

    <div class="footer">
        TEL.(612) 146 13 57 TEL.(612) 146 13 57
    </div>

    <div class="line"></div>

    <div class="footer">
        COPIA CLIENTE
    </div>

</body>
</html>
