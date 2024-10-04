@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Clientes</h1>
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
            <h3 class="card-title">Lista de Clientes</h3>
            <div class="card-tools" style="float: right;">
                <a href="{{ route('clientes.create') }}" class="btn btn-block bg-gradient-primary btn-sm">Nuevo Cliente</a>
            </div>
        </div>

        <div class="card-body">
            <!-- Si no hay clientes -->
            @if ($clientes->isEmpty())
                <div class="alert alert-warning">No hay clientes disponibles.</div>
            @else
                {{-- Setup data for datatables --}}
                @php
                    $heads = [
                        'Id',
                        'Nombre',
                        'Paterno',
                        'Materno',
                        'Correo Electronico',
                        'Celular',
                        ['label' => 'Acciones', 'no-export' => true, 'width' => 15],
                    ];

                    $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </button>';
                    $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                    </button>';
                    $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                        <i class="fa fa-lg fa-fw fa-eye"></i>
                    </button>';

                    $config = [
                        'language' => ['url' => '//cdn.datatables.net/plug-ins/2.1.7/i18n/es-MX.json'],
                        'paging' => true,
                        'searching' => true,
                        'info' => true,
                        'autoWidth' => false,
                    ];
                @endphp

                {{-- Minimal example / fill data using the component slot --}}
                <x-adminlte-datatable id="table1" :heads="$heads" :config="$config">
                    @foreach ($clientes as $cliente)
                        {{-- <tr data-toggle="tooltip" title="Cliente: {{ $cliente->nombre }} {{ $cliente->paterno }} {{ $cliente->materno }}"> --}}
                            <td>{{ $cliente->id }}</td>
                            <td>{{ $cliente->nombre }}</td>
                            <td>{{ $cliente->paterno }}</td>
                            <td>{{ $cliente->materno }}</td>
                            <td>{{ $cliente->correoElectronico }}</td>
                            <td>{{ $cliente->celular }}</td>
                            <td>
                                <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="formEliminar" style="display: inline">
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
    <style>
        /* Efecto hover sobre la fila */
        #table1 tbody tr:hover {
            background-color: #f2f2f2;
            cursor: pointer;
        }

        /* Estilo del tooltip */
        [data-toggle="tooltip"] {
            position: relative;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Inicializar tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Confirmación de eliminación
            $('.formEliminar').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro de eliminar el registro?',
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
