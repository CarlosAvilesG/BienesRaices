<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato de Promesa de Compra-Venta</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }
        h1 {
            text-align: center;
            text-transform: uppercase;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .text-center {
            text-align: center;
        }
        .section-title {
            font-weight: bold;
            text-decoration: underline;
            margin-top: 20px;
        }
        .signature {
            margin-top: 50px;
        }
        .signature-line {
            display: inline-block;
            width: 200px;
            border-top: 1px solid #000;
            text-align: center;
            margin-right: 40px;
        }
    </style>
</head>
<body>
    <h1>Contrato de Promesa de Compra-Venta</h1>

    <p>
        En la ciudad de <strong>{{ $contratoData['ciudad'] ?? 'Baja California Sur' }}</strong>, a los <strong>{{ now()->format('d') }}</strong> días del mes de <strong>{{ now()->format('F') }}</strong> del año <strong>{{ now()->format('Y') }}</strong>,
        comparecen por una parte el Sr.(a) <strong>{{ $contratoData['cliente'] }}</strong>, en adelante referido como "EL PROMITENTE COMPRADOR",
        y por la otra parte el Sr.(a) <strong>{{ $contratoData['vendedor'] ?? 'Nombre del Vendedor' }}</strong>, en adelante referido como "EL PROMITENTE VENDEDOR".
    </p>

    <p>
        Ambas partes convienen en celebrar el presente contrato de Promesa de Compra-Venta sujeto a las siguientes cláusulas:
    </p>

    <p class="section-title">Cláusula Primera - Objeto del Contrato</p>
    <p>
        "EL PROMITENTE VENDEDOR" se obliga a vender y "EL PROMITENTE COMPRADOR" se obliga a comprar el lote identificado como <strong>Manzana: {{ $contratoData['lote']['manzana'] }}, Lote: {{ $contratoData['lote']['lote'] }}</strong>,
        ubicado en <strong>{{ $contratoData['predio'] }}</strong>, con una superficie de <strong>{{ $contratoData['lote']['metrosCuadrados'] }}</strong> metros cuadrados.
    </p>

    <p class="section-title">Cláusula Segunda - Precio</p>
    <p>
        El precio total pactado por el predio es la cantidad de <strong>{{ $contratoData['precio'] }}</strong> ({{ convertirNumeroALetras($contratoData['precio']) }}),
        que será pagado bajo los términos y condiciones establecidos en este contrato.
    </p>

    <p class="section-title">Cláusula Tercera - Condiciones de Pago</p>
    <p>
        Las partes acuerdan que el pago se realizará de la siguiente forma:
    </p>
    <ul>
        <li>Número de letras (pagos): <strong>{{ $contratoData['letras'] ?? 'N/A' }}</strong></li>
        <li>Interés moroso en caso de retraso: <strong>{{ $contratoData['interes'] ?? 'N/A' }}%</strong></li>
        <li>Convenio temporalidad de pago: <strong>{{ $contratoData['temporalidad'] ?? 'N/A' }}</strong></li>
        <li>Vía de pago: <strong>{{ $contratoData['viaPago'] ?? 'N/A' }}</strong></li>
    </ul>

    <p class="section-title">Cláusula Cuarta - Plazo</p>
    <p>
        "EL PROMITENTE COMPRADOR" deberá realizar el pago total del precio acordado en un plazo no mayor a <strong>{{ $contratoData['plazo'] ?? 'N/A' }}</strong>
        a partir de la fecha de la firma de este contrato. En caso de incumplimiento, se aplicará el interés moroso acordado en la cláusula anterior.
    </p>

    <p class="section-title">Cláusula Quinta - Observaciones</p>
    <p>
        {{ $contratoData['observacion'] ?? 'No hay observaciones adicionales.' }}
    </p>

    <div class="signature text-center">
        <div class="signature-line">
            EL PROMITENTE COMPRADOR<br>{{ $contratoData['cliente'] }}
        </div>
        <div class="signature-line">
            EL PROMITENTE VENDEDOR<br>{{ $contratoData['vendedor'] ?? 'Nombre del Vendedor' }}
        </div>
    </div>

</body>
</html>
