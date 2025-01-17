@extends('adminlte::page')

@section('title', 'Pagos de Lotes')

@section('content_header')
    <h1>Pagos de Lotes</h1>
@stop

@section('content')

    <!-- Mostrar mensaje de éxito si existe -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Filtros para predios, lotes y contratos -->
    {{-- <div class="card">
        <div class="card-header">
            <h3 class="card-title">Filtros</h3>
        </div>
        <div class="card-body">
            <form id="filter-form" method="GET" action="{{ route('pagos-lote.index') }}">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="idPredio">Predio</label>
                        <select id="idPredio" name="idPredio" class="form-control">
                            <option value="">-- Seleccione un predio --</option>
                            @foreach ($predios as $predio)
                                <option value="{{ $predio->id }}" {{ request('idPredio') == $predio->id ? 'selected' : '' }}>
                                    {{ $predio->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="idLote">Lote</label>
                        <select id="idLote" name="idLote" class="form-control">
                            <option value="">-- Seleccione un lote --</option>
                            @foreach ($lotes as $lote)
                                <option value="{{ $lote->id }}" {{ request('idLote') == $lote->id ? 'selected' : '' }}>
                                    {{ $lote->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="idContrato">Contrato</label>
                        <select id="idContrato" name="idContrato" class="form-control">
                            <option value="">-- Seleccione un contrato --</option>
                            @foreach ($contratos as $contrato)
                                <option value="{{ $contrato->id }}" {{ request('idContrato') == $contrato->id ? 'selected' : '' }}>
                                    {{ $contrato->noContrato }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Filtrar</button>
            </form>
        </div>
    </div> --}}

    <!-- Detalles del Contrato y Cliente -->
    <div class="card-header">
        <h3 class="card-title">Lista de Contratos</h3>
        <div class="card-tools">
            @if($contratoActivo)
                <a href="{{ route('pagos-lote.createByContrato', $contratoActivo->id) }}" class="btn btn-block bg-gradient-primary btn-sm">Nuevo Pago</a>
            @endif
        </div>
    </div>
    @if ($pagos->isNotEmpty())
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detalles del Contrato</h3>
                <div class="form-group">
                    <label for="contrato-select">Seleccionar Contrato:</label>
                    <select id="contrato-select" name="contrato_id" class="form-control">
                        @foreach ($contratos as $contrato)
                            <option value="{{ $contrato->id }}"
                                {{ $contratoActivo && $contratoActivo->id == $contrato->id ? 'selected' : '' }}>
                                {{ $contrato->noContrato }} - {{ $contrato->estatus }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-body" id="detalle-contrato">
                @if ($contratoActivo)
                    <h5>Folio Contrato: {{ $contratoActivo->id }}</h5>
                    <p>
                        <strong>No. Contrato:</strong> {{ $contratoActivo->noContrato ?? 'N/A' }}<br>
                        <strong>Convenio:</strong> {{ $contratoActivo->noConvenio ?? 'N/A' }}<br>
                        <strong>Precio del Predio:</strong> ${{ number_format($contratoActivo->precioPredio, 2) }}<br>
                        <strong>Fecha de Celebración:</strong> {{ \Carbon\Carbon::parse($contratoActivo->fechaCelebracion)->format('d/m/Y') }}<br>
                    </p>

                    @if ($contratoActivo->cliente)
                        <h5>Cliente</h5>
                        <p>
                            <strong>Nombre:</strong> {{ $contratoActivo->cliente->nombre }} {{ $contratoActivo->cliente->paterno }} {{ $contratoActivo->cliente->materno }}<br>
                            <strong>Email:</strong> {{ $contratoActivo->cliente->email ?? 'No especificado' }}<br>
                        </p>
                    @endif
                @endif
            </div>
        </div>
    @endif

    <!-- Tabla de pagos -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pagos</h3>
        </div>
        <div class="card-body">
            @if ($pagos->isEmpty())
                <div class="alert alert-info">No se encontraron pagos para los filtros seleccionados.</div>
            @else
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Manzana</th>
                            <th>Lote</th>
                            <th>Cliente</th>
                            <th>Motivo</th>
                            <th>Monto</th>
                            <th>Referencia Bancaria</th>
                            <th>No. Pago</th>
                            <th>Fecha de Pago</th>
                            <th>Hora</th>
                            <th>Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pagos as $pago)
                            <tr>
                                <td>{{ $pago->id }}</td>
                                <td>{{ $pago->lote->manzana ?? 'N/A' }}</td>
                                <td>{{ $pago->lote->lote ?? 'N/A' }}</td>
                                <td>{{ $pago->cliente->nombre ?? 'N/A' }} {{ $pago->cliente->paterno ?? '' }} {{ $pago->cliente->materno ?? '' }}</td>
                                <td>{{ $pago->motivo }}</td>
                                <td>{{ number_format($pago->monto, 2) }}</td>
                                <td>{{ $pago->referenciaBancaria ?? 'N/A' }}</td>
                                <td>{{ $pago->pagoNumero ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($pago->fechaPago)->format('d/m/Y') }}</td>
                                <td>{{ $pago->horaPago }}</td>
                                <td>{{ $pago->observacion }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Paginación -->
                <div class="d-flex justify-content-center">
                    {{ $pagos->links() }}
                </div>
            @endif
        </div>
    </div>

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
    </script>
@stop
