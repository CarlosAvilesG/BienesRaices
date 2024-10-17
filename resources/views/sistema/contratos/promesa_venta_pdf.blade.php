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
            text-align: justify;
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
        .bold {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Contrato de Promesa de Compra-Venta</h1>

    <p>
        En la ciudad de <strong>{{ $contratoData['ciudad'] ?? 'Baja California Sur' }}</strong>, a los
        <strong>{{ now()->format('d') }}</strong> días del mes de <strong>{{ now()->format('F') }}</strong> del año
        <strong>{{ now()->format('Y') }}</strong>, comparecen por una parte el Sr.(a)
        <strong>{{ $contratoData['cliente'] }}</strong>, en adelante referido como "EL PROMITENTE COMPRADOR",
        y por la otra parte el Sr.(a) <strong>{{ $contratoData['vendedor'] ?? 'Nombre del Vendedor' }}</strong>,
        en adelante referido como "EL PROMITENTE VENDEDOR".
    </p>

    <p>
        Ambas partes, de manera libre y voluntaria, manifiestan su consentimiento para celebrar el presente Contrato de
        Promesa de Compra-Venta, sujeto a las siguientes cláusulas:
    </p>

    <p class="section-title">Cláusula Primera - Objeto del Contrato</p>
    <p>
        "EL PROMITENTE VENDEDOR" se obliga a vender y "EL PROMITENTE COMPRADOR" se obliga a comprar el lote identificado
        como <strong>Manzana: {{ $contratoData['lote']['manzana'] }}, Lote: {{ $contratoData['lote']['lote'] }}</strong>,
        ubicado en el predio <strong>{{ $contratoData['predio'] }}</strong>, con una superficie de
        <strong>{{ $contratoData['lote']['metrosCuadrados'] }}</strong> metros cuadrados, conforme a los términos y condiciones
        establecidos en este contrato.
    </p>

    <p class="section-title">Cláusula Segunda - Precio</p>
    <p>
        El precio total pactado por el lote es la cantidad de <strong>${{ $contratoData['precio'] }}</strong>
        ({{ $contratoData['precioLetras'] }} M.N.), el cual será pagado por "EL PROMITENTE COMPRADOR" a "EL PROMITENTE VENDEDOR"
        de acuerdo con las siguientes condiciones de pago.
    </p>

    <p class="section-title">Cláusula Tercera - Condiciones de Pago</p>
    <p>
        "EL PROMITENTE COMPRADOR" se compromete a pagar el precio del lote en las siguientes condiciones:
    </p>
    <ul>
        <li><strong>Número de letras (pagos):</strong> {{ $contratoData['letras'] ?? 'N/A' }}</li>
        <li><strong>Interés moroso en caso de retraso:</strong> {{ $contratoData['interes'] ?? 'N/A' }}%</li>
        <li><strong>Temporalidad de pago:</strong> {{ $contratoData['temporalidad'] ?? 'N/A' }} (Ejemplo: Mensual, Quincenal)</li>
        <li><strong>Vía de pago:</strong> {{ $contratoData['viaPago'] ?? 'N/A' }} (Ejemplo: Efectivo, Bancario)</li>
    </ul>

    <p>
        El monto mensual o quincenal será determinado en función del número de letras pactadas, que cubrirán el precio total del
        lote. En caso de mora en los pagos, se aplicará el interés moroso acordado sobre las cantidades adeudadas.
    </p>

    <p class="section-title">Cláusula Cuarta - Plazo</p>
    <p>
        El plazo máximo para la liquidación del precio total del lote es de <strong>{{ $contratoData['plazo'] ?? '12 meses' }}</strong>.
        "EL PROMITENTE COMPRADOR" deberá cumplir con los pagos en los tiempos establecidos. En caso de incumplimiento, "EL PROMITENTE
        VENDEDOR" podrá dar por terminado este contrato y hacer uso de los recursos legales correspondientes para recuperar el bien.
    </p>

    <p class="section-title">Cláusula Quinta - Obligaciones de las Partes</p>
    <p>
        Ambas partes se obligan a cumplir con los términos de este contrato, siendo responsabilidad de "EL PROMITENTE COMPRADOR"
        efectuar los pagos en tiempo y forma. Asimismo, "EL PROMITENTE VENDEDOR" se compromete a realizar la transferencia de
        propiedad una vez que se haya cubierto el precio total pactado, de acuerdo con las leyes aplicables.
    </p>

    <p class="section-title">Cláusula Sexta - Penalizaciones por Incumplimiento</p>
    <p>
        En caso de que "EL PROMITENTE COMPRADOR" incumpla con los pagos establecidos en el presente contrato, se le aplicará un
        interés moratorio del {{ $contratoData['interes'] ?? 'N/A' }}% sobre las cantidades adeudadas, sin perjuicio de las demás
        acciones legales que "EL PROMITENTE VENDEDOR" pueda ejercer para la recuperación del lote.
    </p>

    <p class="section-title">Cláusula Séptima - Observaciones</p>
    <p>
        {{ $contratoData['observacion'] ?? 'No hay observaciones adicionales.' }}
    </p>

    <p class="section-title">Cláusula Octava - Jurisdicción</p>
    <p>
        Para todo lo relativo a la interpretación y cumplimiento del presente contrato, las partes se someten a la jurisdicción
        de los tribunales competentes de la ciudad de <strong>{{ $contratoData['ciudad'] ?? 'La Paz' }}</strong>, Baja California Sur,
        renunciando a cualquier otro fuero que pudiera corresponderles por razón de sus domicilios presentes o futuros.
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
