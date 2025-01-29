<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo de Pago</title>
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">

     <!-- Librería html2canvas -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>




    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .header {
            background-color: #8B0000;
            color: white;
            padding: 10px;
            font-weight: bold;
            text-align: center;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .boton {
            background-color: #8B0000;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            margin: 5px;
            border-radius: 5px;
            transition: background 0.3s ease-in-out;
        }

        .boton:hover {
            background-color: #600000;
        }

        .checkbox-container {
            margin: 15px 0;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
        }

        .checkbox-container label {
            margin-right: 10px;
        }

        .recibo-container {
            width: 794px;
            height: 1123px;
            background-color: white;
            border: 1px solid black;
            padding: 10px;
            margin: auto;
            position: relative;
            overflow: hidden;
        }

        .recibo-copia {
            border-top: 2px dashed #8B0000;
            padding-top: 10px;
            text-align: center;
            font-weight: bold;
            position: relative;
        }
        .ocultar-borde {
            display: none !important;
        }


    </style>
</head>
<body>

    <div class="container text-center">
        <!-- Contenedor de botones y opciones -->
        <div >
            {{-- <button id="btnCapturar" class="boton">📷 Descargar Recibo</button> --}}
            <button id="btnImprimir" class="boton">🖨️ Imprimir Recibo</button>
            {{-- regresar a la pagina anterior --}}
            <a href="{{ route('pagos-lote.index', ['idContrato' => $pago->idContrato]) }}" class="boton">🔙 Regresar</a>
        </div>

        <div class="checkbox-container">
            <label for="copias">Número de copias:</label>
            <select id="copias">
                <option value="0">0 Copias</option>
                <option value="1">1 Copia</option>
                <option value="2">2 Copias</option>
            </select>
        </div>
    </div>

    <!-- Contenedor principal del recibo -->
    <div class="recibo-container" id="reciboContainer">
    <!-- ENCERRAMOS TODO EL RECIBO EN UN CONTENEDOR -->
        <div id="recibo" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 0px;">
            {{-- secciona en tres la pagina en partes iguales --}}
            <div class="container" style="margin-top: 0px; margin-bottom: 0px;">
                <div class="row"  style="height: 48px;">
                    <div class="col-md-3" >
                        <div class="card">
                            <div class="header"  style=" border-top-left-radius: 15px; border-top-right-radius: 15px; height: 20px ; padding-top: 2px "> Fecha</div>

                            <div class="card-body" style="text-align: center; border: 1px solid #8B0000;   padding-top: 5px;  padding-bottom: 10px;  ">
                                <div class="center"  style="font-size: 14px; font-weight: bold;  height: 10px; " >{{ \Carbon\Carbon::parse($pago->fechaPago)->format('d/m/Y') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="text-align: center; display: flex; align-items: center; justify-content: center;">
                        <div class="center" >
                            {{-- <img src="{{ public_path('images/logo.png') }}" alt="Logo" style="max-height: 100px; width: auto;"> --}}
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="max-height: 70px; width: auto;">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="header" style=" border-top-left-radius: 15px; border-top-right-radius: 15px;  height: 20px; padding-top: 3px ">Folio</div>

                            <div class="card-body" style="text-align: center; border: 1px solid #8B0000;  padding-top: 5px;  padding-bottom: 10px;  ">
                                <div class="center" style="font-size: 14px; font-weight: bold;  height: 10px;">ID:{{ $pago->id }} - Folio:{{ $pago->folio }} </div>
                                {{-- <div class="center" style="font-size: 16px; font-weight: bold;  height: 15px; ">No.Folio:{{ $pago->folio }}</div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- secciona en tres la pagina en partes iguales --}}
            <div class="container" style="margin-top: 0px; margin-bottom: 0px;">
                <div class="row" style="height: 10px;">
                    <div class="col-md-3" style="text-align: center; padding: 5px; font-size: 11px;">

                    </div>

                    <div class="col-md-6" style="text-align: center; padding-top: 2px; font-size: 10px;">
                        <div class="center">{{ $datosEmpresa->direccion }}</div>
                    </div>

                    <div class="col-md-3" style="text-align: center; padding-top: 2px; font-size: 11px;">
                        <div class="center">Telefono: {{ $datosEmpresa->telefono1 }}</div>
                        <div class="center">Telefono: {{ $datosEmpresa->telefono2 }}</div>
                    </div>
                </div>
            </div>

            <div class="container" style="margin-top: 0px; margin-bottom: 0px;">
                <div class="row" style="height: 78px;">
                    <div class="col-md-12">
                        <div  >
                            <div class="d-flex align-items-center">
                                <div class="header text-left" style="width: 30%; background-color: #8B0000; color: white; font-weight: bold; padding: 3px; border-top-left-radius: 0px;  border-top-right-radius: 100%;  align-items: center; height: 20px;">
                                    DATOS DEL CLIENTE
                                </div>
                                {{-- <div class="flex-grow-1 border-top border-dark"></div> --}}
                            </div>
                            <div class="card-body" style="text-align: left; border: 1px solid #8B0000; border-bottom-left-radius: 20px; border-top-right-radius: 20px; padding-top: 5px; padding-bottom: 5px;">
                                <div  class="row" >
                                    <div class="col-md-8">
                                        <div class="data-row"><span><strong>Nombre:</strong></span> {{ $pago->cliente->nombre_completo }} </div>
                                    </div>
                                    <div class="col-md-4">
                                        {{-- <div class="data-row"><span><strong>Teléfono:</strong></span> {{ $pago->cliente->telefonoCasa }} / --}}
                                            <div class="data-row"><strong>Celular:</strong> {{ $pago->cliente->celular }}</div>
                                    </div>

                                </div>
                                <div class="data-row"><span><strong>Dirección:</strong></span> {{ $pago->cliente->direccion }}</div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container" style="margin-top: 0px; margin-bottom: 0px;">
                <div class="row" style="height: 78px;">
                    <div class="col-md-12">
                        <div  >
                            <div class="d-flex align-items-center">
                                <div class="header text-left" style="width: 30%; background-color: #8B0000; color: white; font-weight: bold; padding: 3px; border-top-left-radius: 0px;  border-top-right-radius: 100%;  align-items: center; height: 20px;">
                                    DATOS DEL PREDIO
                                </div>
                                {{-- <div class="flex-grow-1 border-top border-dark"></div> --}}
                            </div>
                            <div class="card-body" style="text-align: left; border: 1px solid #8B0000; border-bottom-left-radius: 20px; border-top-right-radius: 20px; padding-top: 5px; padding-bottom: 5px;">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="data-row"><span><strong>Predio:</strong></span> {{ $pago->lote->predio->nombre }} </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="data-row"><span><strong>Manzana:</strong></span> {{ $pago->lote->manzana }}</div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="data-row"><span><strong>Lote:</strong></span> {{ $pago->lote->lote }}</div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="data-row"><span><strong>Superficie:</strong></span> {{ $pago->lote->metrosCuadrados }} m<sup>2</sup></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 d-flex align-items-center justify-content-center" style="font-size: 18px; font-weight: bold; border-left: 1px solid #8B0000;">
                                        <div class="data-row text-center">
                                            <span><strong>{{ $pago->motivo}} No.:</strong></span> {{ $pago->pagoNumero }}
                                            @if($pago->motivo == 'Mensualidad')
                                                <span><strong> de </strong></span> {{ $pago->contrato->noLetras }}
                                            @elseif($pago->motivo == 'Anualidad')
                                                <span><strong> de </strong></span> {{ $pago->contrato->anualidades }}
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                {{-- <div class="data-row">

                                    <span><strong>Observaciones:</strong></span>
                                    {{ $pago->lote->observaciones }}

                                </div> --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container" style="margin-top: 0px; margin-bottom: 0px;">
                <div class="row">
                    <div class="col-md-12">
                        <div  >
                            <div class="d-flex align-items-center">
                                <div class="header text-left" style="width: 30%; background-color: #8B0000; color: white; font-weight: bold; padding: 3px; border-top-left-radius: 0px;  border-top-right-radius: 100%;  align-items: center; height: 20px;">
                                    CONCEPTO
                                </div>
                                {{-- <div class="flex-grow-1 border-top border-dark"></div> --}}
                            </div>
                            <div class="card-body" style="text-align: left; border: 1px solid #8B0000; border-bottom-left-radius: 20px; border-top-right-radius: 20px; padding-top: 5px; padding-bottom: 5px;">

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="data-row"><span><strong>Motivo:</strong></span> {{ $pago->motivo }} </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="data-row"><span><strong>Tipo:</strong></span> {{ $pago->tipoPago }}</div>
                                    </div>
                                    <div class="col-md-4">
                                        {{ $pago->condicionesPago }}
                                        @if($pago->referenciaBancaria)
                                        <strong> REF.BANCO:</strong> {{ $pago->referenciaBancaria }}
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <div class="data-row"><span><strong>Monto: </strong></span>${{ number_format($pago->monto, 2) }} M.N.</div>
                                    </div>

                                </div>

                                <div class="data-row">
                                    Freccionamiento Rustico {{ $pago->predio->nombre}}, recibe la cantidad correspondiente a: {{  $pago->getPagoCorrespondienteAttribute()  }}.
                                    {{ $pago->observaciones }}
                                </div>

                                <div class="data-row"><span><strong>Cantidad en Letra:: </strong></span>{{  Str::upper( $pago->getMontoFormateadoAttribute()) }} </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container" style="margin-top: 5px; margin-bottom: 0px;">
                <div class="row">
                    <div class="col-md-4" style="text-align: center;" >
                        {{ $pago->usuario->name }}
                        <div >
                        <hr style="border: 1px solid #8B0000; width: 100%; margin-top: 0%; margin-bottom: 0%">
                        RECIBO DE PAGO
                        </div>
                    </div>
                    <div class="col-md-4" style="text-align: center; ">
                    <div style="font-size: 6px; text-align: center;">
                        Fecha de Impresión: {{ \Carbon\Carbon::now()->format('d/m/Y') }}
                    </div>

                    </div>
                    <div class="col-md-4" style="text-align: center; ">
                        {{ $pago->cliente->nombre_completo }}
                        <div >
                            <hr style="border: 1px solid #8B0000; width: 100%; margin-top: 0%; margin-bottom: 0%">
                            FIRMA DEL CLIENTE
                        </div>

                    </div>
                </div>
            </div>
{{--
            <div class="ultima-seccion" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 0px;  margin-left: 25px; margin-right: 25px;">
                <hr style="border: 1px dashed #8B0000; width: 100%; margin-top: 0%; margin-bottom: 0%">
            </div> --}}

        </div>
    </div> <!-- Fin del reciboContainer -->

    <script>
        function generarCopias() {
            let copias = parseInt(document.getElementById("copias").value);
            let reciboContainer = document.getElementById("reciboContainer");

            document.querySelectorAll(".recibo-copia").forEach(copia => copia.remove());

            for (let i = 0; i < copias; i++) {
                let copia = document.createElement("div");
                copia.classList.add("recibo-copia");
                copia.innerHTML = document.getElementById("recibo").innerHTML;
                reciboContainer.appendChild(copia);
            }

            let ultimasCopias = document.querySelectorAll(".recibo-copia");
            if (ultimasCopias.length > 0) {
                let ultimaCopia = ultimasCopias[ultimasCopias.length - 1];
                let ultimaSeccion = ultimaCopia.querySelector(".ultima-seccion");
                if (ultimaSeccion) {
                    ultimaSeccion.remove();
                }
            }
        }

        document.getElementById("btnImprimir").addEventListener("click", function () {
            generarCopias();
            let reciboContainer = document.getElementById("reciboContainer");

            html2canvas(reciboContainer, {
                scale: 1.5,
                allowTaint: true,
                useCORS: true
            }).then(canvas => {
                const { jsPDF } = window.jspdf;
                let pdf = new jsPDF({
                    orientation: "portrait",
                    unit: "mm",
                    format: "a4",
                    compress: true
                });

                let imgData = canvas.toDataURL("image/jpeg", 0.8);

                let pageWidth = pdf.internal.pageSize.getWidth();
                let pageHeight = pdf.internal.pageSize.getHeight();

                let imgWidth = pageWidth - 10;
                let imgHeight = (canvas.height * imgWidth) / canvas.width;

                if (imgHeight > pageHeight - 10) {
                    imgHeight = pageHeight - 10;
                }

                pdf.addImage(imgData, "JPEG", 5, 5, imgWidth, imgHeight);

                pdf.save("recibo_pago.pdf"); // DESCARGAR EN LUGAR DE ABRIR
            });
        });

        document.getElementById("btnCapturar").addEventListener("click", function () {
            generarCopias();
            let reciboContainer = document.getElementById("reciboContainer");

            html2canvas(reciboContainer, {
                scale: 1.5,
                allowTaint: true,
                useCORS: true
            }).then(canvas => {
                let imgData = canvas.toDataURL("image/png");

                let link = document.createElement("a");
                link.href = imgData;
                link.download = "recibo_pago.png";
                link.click();
            });
        });
    </script>

</body>
</html>
