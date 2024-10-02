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

    <!-- Card para seleccionar un predio -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Seleccionar Predio</h3>
        </div>
        <div class="card-body">
            <form id="form-select-predio">
                <div class="form-group">
                    <label for="predio-select">Seleccione un Predio</label>
                    <select id="predio-select" name="predio_id" class="form-control">
                        <option value="">-- Seleccione un predio --</option>
                        @foreach ($predios as $predio)
                            <option value="{{ $predio->id }}" {{ request('predio_id') == $predio->id ? 'selected' : '' }}>{{ $predio->id }} - {{ $predio->nombre }} - {{ $predio->descripcion }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>

    <!-- Card para mostrar la lista de lotes -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Lotes</h3>
            <div class="card-tools">
                <!-- Botón para crear un nuevo lote, pasando el ID del predio seleccionado -->
                <a href="#" id="crear-lote-btn" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> Crear Lote
                </a>
            </div>
        </div>
        <div class="card-body">

            <!-- Si no hay lotes -->
            <div id="lotes-content">
                @if ($lotes->isEmpty())
                    <div class="alert alert-info">Seleccione un predio para ver los lotes disponibles.</div>
                @else
                    <!-- Aquí se carga el partial de lotes -->
                    @include('sistema.lotes.partials.lotes_table', ['lotes' => $lotes])
                @endif
            </div>

        </div>
    </div>

@stop

@section('js')
    {{-- Asegúrate de que el archivo JS de DataTables esté cargado --}}
    <script>
        $('#predio-select').on('change', function() {
            var predioId = $(this).val();  // Obtener el ID del predio seleccionado

            // Cambiar el enlace del botón "Crear Lote" para incluir el ID del predio seleccionado
            if (predioId) {
                $('#crear-lote-btn').attr('href', '{{ route('lotes.create') }}' + '?predio_id=' + predioId);
            } else {
                $('#crear-lote-btn').attr('href', '#'); // Si no hay predio seleccionado, deshabilitar el botón
            }

            if (!predioId) {
                $('#lotes-content').html('<div class="alert alert-warning">Seleccione un predio válido.</div>');
                return;
            }

            // Cargar los lotes mediante AJAX
            $.ajax({
                url: '{{ route('lotes.porPredio') }}',
                method: 'GET',
                data: { predioId: predioId },  // Enviar el ID del predio
                success: function(data) {
                    $('#lotes-content').html(data);
                },
                error: function(xhr) {
                    var errorMessage = 'Error al cargar los lotes. Inténtelo de nuevo más tarde.';
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        errorMessage = xhr.responseJSON.error;
                    } else if (xhr.status === 404) {
                        errorMessage = 'No se encontraron lotes para el predio seleccionado.';
                    }
                    $('#lotes-content').html('<div class="alert alert-danger">' + errorMessage + '</div>');
                }
            });
        });
    </script>
@stop
