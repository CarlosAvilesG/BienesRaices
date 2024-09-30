@extends('adminlte::page')

@section('title', 'Lotes')

@section('content_header')
    <h1>Lotes</h1>
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

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Lotes</h3>
            <div class="card-tools">
                <a href="{{ route('lotes.create') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> Crear Lote
                </a>
            </div>
        </div>
        <div class="card-body">

            <!-- Si no hay lotes -->
            @if ($lotes->isEmpty())
                <div class="alert alert-warning">No hay lotes disponibles.</div>
            @else
                {{-- Setup data for datatables --}}
                @php
                    $heads = [
                        'ID',
                        'Manzana',
                        'Lote',
                        'Descripción',
                        'Metros Cuadrados',
                        'Precio',
                        'Estatus de Pago',
                        'Acciones',
                    ];

                    $config = [
                        'language' => ['url' => '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'],
                        'paging' => true,
                        'searching' => true,
                        'info' => true,
                        'autoWidth' => false,
                    ];
                @endphp

                {{-- Minimal example / fill data using the component slot --}}
                <x-adminlte-datatable id="table1" :heads="$heads" :config="$config">
                    @foreach ($lotes as $lote)
                        <tr>
                            <td>{{ $lote->id }}</td>
                            <td>{{ $lote->manzana }}</td>
                            <td>{{ $lote->lote }}</td>
                            <td>{{ $lote->descripcion ?? 'N/A' }}</td>
                            <td>{{ number_format($lote->metrosCuadrados, 2) }} m²</td>
                            <td>${{ number_format($lote->precio, 2) }}</td>
                            <td>
                                @if ($lote->estatusPago == 'pagado')
                                    <span class="badge badge-success">Pagado</span>
                                @elseif ($lote->estatusPago == 'pendiente')
                                    <span class="badge badge-warning">Pendiente</span>
                                @else
                                    <span class="badge badge-danger">Atrasado</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('lotes.show', $lote->id) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('lotes.edit', $lote->id) }}" class="btn btn-warning btn-sm">Editar</a>

                                <form action="{{ route('lotes.destroy', $lote->id) }}" method="POST" class="d-inline formEliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>

            @endif

        </div>
    </div>

@stop

@section('css')
    {{-- Carga los estilos de AdminLTE y DataTables --}}
@stop

@section('js')
    {{-- Asegúrate de que el archivo JS de DataTables esté cargado --}}
    <script>
        $(document).ready(function() {
            $('.formEliminar').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro de eliminar el lote?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, eliminarlo!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                })
            });
        });
    </script>
@stop
