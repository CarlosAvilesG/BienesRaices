@extends('adminlte::page')

@section('title', 'Pagos de Lotes')

@section('content_header')
    <h1><i class="fas fa-money-check-alt"></i> Pagos de Lotes</h1>
@stop

@section('content')

    <!-- Mostrar mensaje de éxito si existe -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Filtros para predios, lotes y contratos -->
    {{-- <div class="card">
        <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
            <h3 class="card-title"><i class="fas fa-file-contract"></i> Detalles del Contrato</h3>

             <div class="form-group mb-0 d-flex align-items-center">
                <label for="contrato-select" class="mr-2 font-weight-bold">Seleccionar Contrato:</label>
                <select id="contrato-select" name="contrato_id" class="form-control form-control-sm w-auto">
                    @foreach ($contratos as $contrato)
                        <option value="{{ $contrato->id }}" {{ $contratoActivo && $contratoActivo->id == $contrato->id ? 'selected' : '' }}>
                            {{ $contrato->noContrato }} - {{ $contrato->estatus }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="card-body">

        </div>
    </div> --}}
    @include('sistema.pago_lotes.partials.detalle_contrato')
    <!-- Separador con línea horizontal -->
<!-- Espaciado antes de la tabla -->
<div class="mt-4 mb-3">
    <h4 class="text-center text-bold"><i class="fas fa-table"></i> Historial de Pagos</h4>
</div>


    @if ($pagos->isNotEmpty())

        <!-- Tabla de pagos -->
        <div class="card">
            <div class="card-header bg-info text-white">
                <div class="row w-100 align-items-center">
                    <div class="col-md-6">
                        <h3 class="card-title m-0">
                            <i class="fas fa-hand-holding-usd"></i> Pagos Registrados
                        </h3>
                    </div>
                    <div class="col-md-6 text-right">
                        @if($contrato)
                            <a href="{{ route('pagos-lote.createByContrato', $contrato->id) }}"
                               class="btn btn-sm btn-success btn-flat shadow-sm font-weight-bold">
                                <i class="fas fa-plus"></i> Nuevo Pago
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if ($pagos->isEmpty())
                    <div class="alert alert-info"><i class="fas fa-info-circle"></i> No se encontraron pagos para los filtros seleccionados.</div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    {{-- <th>Contrato</th>
                                    <th>Predio</th>
                                    <th>Lote</th> --}}
                                    <th>Manzana</th>
                                    <th>Lote</th>
                                    {{-- <th>Cliente</th> --}}
                                    <th>Motivo</th>
                                    <th>Monto</th>
                                    <th>Referencia Bancaria</th>
                                    <th>No. Pago</th>
                                    <th>Fecha de Pago</th>
                                    {{-- <th>Hora</th> --}}
                                    <th>Observaciones</th>
                                    <th>Validado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pagos as $pago)
                                    <tr>
                                        <td>{{ $pago->id }}</td>
                                        {{-- <td>{{ $pago->idContrato }}</td>
                                        <td>{{ $pago->idPredio}}</td>
                                        <td>{{ $pago->idPredio }}</td> --}}
                                        <td>{{ $pago->lote->manzana ?? 'N/A' }}</td>
                                        <td>{{ $pago->lote->lote ?? 'N/A' }}</td>
                                        {{-- <td>{{ $pago->cliente->nombre ?? 'N/A' }} {{ $pago->cliente->paterno ?? '' }} {{ $pago->cliente->materno ?? '' }}</td> --}}
                                        <td>{{ $pago->motivo }}</td>
                                        <td>${{ number_format($pago->monto, 2) }}</td>
                                        <td>{{ $pago->referenciaBancaria ?? 'N/A' }}</td>
                                        <td>{{ $pago->pagoNumero ?? 'N/A' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($pago->fechaPago)->format('d/m/Y') }}<br> {{ $pago->horaPago }}</td>
                                        {{-- <td>{{ $pago->horaPago }}</td> --}}
                                        <td>{{ $pago->observacion }}</td>
                                        <td>
                                            @if($pago->pagoValidado == 1)
                                                <span class="badge badge-success"><i class="fas fa-check-circle"></i> Sí</span>
                                            @else
                                                <span class="badge badge-danger"><i class="fas fa-times-circle"></i> No</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('pagos-lote.show', $pago->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye fa-fw"></i> </a>

                                        @if ($pago && $pago->pagoValidado == 0 && $pago->cancelar == 0)
                                            <form id="cancelar-form-{{ $pago->id }}" action="{{ route('pagos-lote.cancelarPago', $pago->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmarCancelacion({{ $pago->id }})">
                                                    <i class="fas fa-ban fa-fw"></i>
                                                </button>
                                            </form>
                                        @endif

                                        {{-- boton para imprimir recibo de pago --}}
                                        <a href="{{ route('pagos-lote.reciboPdf', $pago->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-print fa-fw"></i>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div class="d-flex justify-content-center">
                        {{ $pagos->links() }}
                    </div>
                @endif
            </div>
        </div>
    @endif
@stop

@section('js')
    <script>
        $('#contrato-select').on('change', function () {
            const contratoId = $(this).val();

            if (contratoId) {
                $.ajax({
                    url: '{{ route("contratos.show", ":id") }}'.replace(':id', contratoId),
                    type: 'GET',
                    success: function (data) {
                        const contrato = data.contrato;
                        const cliente = data.cliente;

                        // Actualizar los detalles del contrato en la vista
                        let detalles = `
                            <h5>Contrato: ${contrato.noContrato}</h5>
                            <p>
                                <strong>Convenio:</strong> ${contrato.noConvenio ?? 'N/A'}<br>
                                <strong>Precio del Predio:</strong> $${Number(contrato.precioPredio).toFixed(2)}<br>
                                <strong>Fecha de Celebración:</strong> ${contrato.fechaCelebracion}<br>
                            </p>
                        `;

                        if (cliente) {
                            detalles += `
                                <h5>Cliente</h5>
                                <p>
                                    <strong>Nombre:</strong> ${cliente.nombre} ${cliente.paterno} ${cliente.materno}<br>
                                    <strong>Email:</strong> ${cliente.email ?? 'No especificado'}<br>
                                </p>
                            `;
                        }

                        $('#detalle-contrato').html(detalles);
                    },
                    error: function () {
                        alert('Error al cargar los detalles del contrato.');
                    }
                });
            }
        });


        // function confirmarCancelacionPago(pagoId) {
        // Swal.fire({
        //     title: 'Confirmar Cancelación',
        //     input: 'textarea',
        //     inputPlaceholder: 'Escribe la razón de la cancelación aquí...',
        //     showCancelButton: true,
        //     confirmButtonText: 'Cancelar Pago',
        //     cancelButtonText: 'Volver',
        //     inputValidator: (value) => {
        //         if (!value) {
        //             return '¡Necesitas escribir una observación antes de continuar!';
        //         }
        //     }
        // }).then((result) => {
        //     if (result.isConfirmed) {
        //         // Obtener el formulario específico para el pago seleccionado
        //         let form = document.getElementById('cancelar-form-' + pagoId);

        //         // Crear un campo oculto para la observación
        //         let input = document.createElement('input');
        //         input.type = 'hidden';
        //         input.name = 'canceladoObservacion';
        //         input.value = result.value;

        //         form.appendChild(input);
        //         form.submit();
        //     }
        // });

        function confirmarCancelacion(pagoId) {
        Swal.fire({
            title: 'Confirmar Cancelación',
            input: 'textarea',
            inputPlaceholder: 'Escribe la razón de la cancelación aquí...',
            showCancelButton: true,
            confirmButtonText: 'Cancelar pago',
            cancelButtonText: 'Volver',
            inputValidator: (value) => {
                if (!value) {
                    return 'Necesitas escribir una observación antes de continuar!';
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {

                // Obtener el formulario correcto basado en el id del pago
                let form = document.getElementById('cancelar-form-' + pagoId);

                let input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'canceladoObservacion';
                input.id = 'canceladoObservacion';
                input.value = result.value;

                form.appendChild(input);
                form.submit();
            }
        });
    }
    </script>
@stop
