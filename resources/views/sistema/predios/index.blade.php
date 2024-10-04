<!DOCTYPE html>
@extends('adminlte::page')

@section('title', 'Predios')

@section('content_header')
    <h1>Predios</h1>
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
            <h3 class="card-title">Lista de Predios</h3>
            <div class="card-tools" style="float: right ;">
                <a href="{{ route('predios.create') }}" class="btn btn-block bg-gradient-primary btn-sm">Nuevo Predio</a>
            </div>
        </div>

        <div class="card-body">

            <!-- Si no hay predios -->
            @if ($predios->isEmpty())
                <div class="alert alert-warning">No hay predios disponibles.</div>
            @else
                {{-- Setup data for datatables --}}
                @php
                    $heads = [
                        'ID',
                        'Nombre',
                        'Descripción',
                        'Estado',
                        'Municipio',
                        'Localidad',
                        'Hectáreas',
                        'Número de Manzanas',
                        'Número de Lotes',
                        'Fecha de Inauguración',
                        'Activo',
                        ['label' => 'Acciones', 'no-export' => true, 'width' => 15],
                    ];

                    $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </button>';
                    $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Eliminar">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                    </button>';
                    $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Detalles">
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
                    @foreach ($predios as $predio)
                        {{-- <tr data-toggle="tooltip" title="Predio: {{ $predio->nombre }} - {{ $predio->descripcion }}"> --}}
                            <td>{{ $predio->id }}</td>
                            <td>{{ $predio->nombre }}</td>
                            <td>{{ $predio->descripcion }}</td>
                            <td>{{ $predio->estadoRepublica }}</td>
                            <td>{{ $predio->municipio }}</td>
                            <td>{{ $predio->localidad }}</td>
                            <td>{{ $predio->hectarias }}</td>
                            <td>{{ $predio->numeroManzanas }}</td>
                            <td>{{ $predio->numeroLotes }}</td>
                            <td>{{ \Carbon\Carbon::parse($predio->fechaInauguracion)->format('d-m-Y') }}</td>
                            <td>
                                @if ($predio->activo)
                                    <span class="badge badge-success">Activo</span>
                                @else
                                    <span class="badge badge-danger">Inactivo</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('predios.show', $predio->id) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('predios.edit', $predio->id) }}" class="btn btn-warning btn-sm">Editar</a>

                                <form action="{{ route('predios.destroy', $predio->id) }}" method="POST"
                                    class="formEliminar" style="display: inline">
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
    {{-- Asegúrate de que el archivo JS de DataTables esté cargado --}}
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
