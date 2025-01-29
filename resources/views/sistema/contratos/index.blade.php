@extends('adminlte::page')

@section('title', 'Contratos')

@section('content_header')
    <h1>Contratos</h1>
@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Contratos</h3>
            <div class="card-tools">
                <a href="{{ route('contratos.create') }}" class="btn btn-block bg-gradient-primary btn-sm">Nuevo Contrato</a>
            </div>
        </div>
        <div class="card-body">

            @if ($contratos->isEmpty())
                <div class="alert alert-warning">No hay contratos disponibles.</div>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Lote</th>
                            <th>No. Contrato</th>
                            <th>Precio Predio</th>
                            <th>Fecha Celebración</th>
                            <th>Estatus</th> <!-- Nueva columna para mostrar el estatus -->
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contratos as $contrato)
                            <tr class="
                                @if($contrato->estatus == 'Cancelado') table-danger
                                @elseif($contrato->estatus == 'Finiquitado') table-success
                                @else table-default
                                @endif
                            ">
                                <td>{{ $contrato->id }}</td>

                                <td>
                                    {{ $contrato->cliente->nombre_completo }}
                                </td>

                                <td>{{ $contrato->lote->descripcion }}</td>
                                <td>{{ $contrato->noContrato }}</td>
                                <td>${{ number_format($contrato->precioPredio, 2) }}</td>
                                <td>{{ \Carbon\Carbon::parse($contrato->fechaCelebracion)->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge
                                        @if($contrato->estatus == 'Activo') badge-primary
                                        @elseif($contrato->estatus == 'Cancelado') badge-danger
                                        @elseif($contrato->estatus == 'Finiquitado') badge-success
                                        @endif">
                                        {{ $contrato->estatus }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('contratos.show', $contrato->id) }}" class="btn btn-info btn-sm">Ver</a>
                                    <a href="{{ route('contratos.edit', $contrato->id) }}" class="btn btn-warning btn-sm">Editar</a>

                                     <!-- Botón para redirigir al índice de pagos-lote -->
                                     <a href="{{ route('pagos-lote.index', ['idContrato' => $contrato->id]) }}" class="btn btn-success btn-sm">
                                        Pagos
                                    </a>

                                    <!-- Si el contrato no está cancelado, mostrar el botón de cancelar -->
                                    @if ($contrato->estatus == 'Activo')
                                        <form action="{{ route('contrato.cancelar', $contrato->id) }}" method="get" class="d-inline">
                                            @csrf
                                            {{-- @method('DELETE') --}}
                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmarCancelacion({{ $contrato->id }})">
                                                Cancelar
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

        </div>
    </div>

@stop

@section('js')
<script>
    function confirmarCancelacion(contratoId) {
        Swal.fire({
            title: 'Confirmar Cancelación',
            input: 'textarea',
            inputPlaceholder: 'Escribe la razón de la cancelación aquí...',
            showCancelButton: true,
            confirmButtonText: 'Cancelar Contrato',
            cancelButtonText: 'Volver',
            inputValidator: (value) => {
                if (!value) {
                    return 'Necesitas escribir una observación antes de continuar!';
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Crear un formulario oculto y agregar la observación
                let form = document.querySelector(`form[action='{{ route('contrato.cancelar', $contrato->id) }}']`);
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

