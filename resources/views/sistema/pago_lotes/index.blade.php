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
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Filtros</h3>
        </div>
        <div class="card-body">
            <form id="filter-form" method="GET" action="{{ route('pago_lotes.index') }}">
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
    </div>

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
                            <th>Predio</th>
                            <th>Lote</th>
                            <th>Cliente</th>
                            <th>Monto</th>
                            <th>Fecha de Pago</th>
                            <th>Hora</th>
                            <th>Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pagos as $pago)
                            <tr>
                                <td>{{ $pago->id }}</td>
                                <td>{{ $pago->predio->nombre ?? 'N/A' }}</td>
                                <td>{{ $pago->lote->nombre ?? 'N/A' }}</td>
                                <td>{{ $pago->cliente->nombre ?? 'N/A' }}</td>
                                <td>{{ number_format($pago->monto, 2) }}</td>
                                <td>{{ $pago->fechaPago }}</td>
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
        // Script adicional para manejar el cambio de predio, lote o contrato
        $('#idPredio, #idLote, #idContrato').on('change', function() {
            $('#filter-form').submit(); // Enviar formulario al cambiar un filtro
        });
    </script>
@stop
