@if ($lotes->isEmpty())
    <div class="alert alert-warning">No hay lotes disponibles para este predio.</div>
@else
    {{-- Setup data for datatables --}}
    @php
        $heads = [
            'ID',
            'Manzana',
            'Lote',
            'Descripción',
            'Precio',
            'Regular',
            'Donación',
            'Comercial',
            'Metros Cuadrados',
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
    <x-adminlte-datatable id="table2" :heads="$heads" :config="$config">
        @foreach ($lotes as $lote)
            <tr data-toggle="tooltip" data-placement="top" title="Lote: {{ $lote->lote }}, Manzana: {{ $lote->manzana }}, Precio: ${{ number_format($lote->precio, 2) }}">
                <td>{{ $lote->id }}</td>
                <td>{{ $lote->manzana }}</td>
                <td>{{ $lote->lote }}</td>
                <td>{{ $lote->descripcion ?? 'No especificada' }}</td>
                <td>${{ number_format($lote->precio, 2) }}</td>
                <td>
                    @if ($lote->regular)
                        <span class="badge badge-success">Sí</span>
                    @else
                        <span class="badge badge-danger">No</span>
                    @endif
                </td>
                <td>
                    @if ($lote->donacion)
                        <span class="badge badge-success">Sí</span>
                    @else
                        <span class="badge badge-danger">No</span>
                    @endif
                </td>
                <td>
                    @if ($lote->loteComercial)
                        <span class="badge badge-success">Sí</span>
                    @else
                        <span class="badge badge-danger">No</span>
                    @endif
                </td>
                <td>{{ $lote->metrosCuadrados }} m²</td>
                <td>
                    <a href="{{ route('lotes.show', $lote->id) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('lotes.edit', $lote->id) }}" class="btn btn-warning btn-sm">Editar</a>

                    <form action="{{ route('lotes.destroy', $lote->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>
@endif

@section('css')
    <style>
        /* Efecto hover sobre la fila de la tabla */
        table tr:hover {
            background-color: #f2f2f2;
            cursor: pointer;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Inicializar tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Agregar efecto hover en la fila
            $('table tr').hover(function() {
                $(this).css('background-color', '#e0e0e0');
            }, function() {
                $(this).css('background-color', '');
            });
        });
    </script>
@stop
