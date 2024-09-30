@extends('adminlte::page')

@section('title', 'Detalles del Predio')

@section('content_header')
    <h1>Detalles del Predio</h1>
@stop

@section('content')
    <div class="container">
        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Errores de validación -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Card: Información General -->
        <div class="card card-primary">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-home"></i> Información General</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{ $predio->nombre }}" readonly>
                    </div>
                    <div class="col-md-8">
                        <label for="descripcion">Descripción</label>
                        <input type="text" name="descripcion" class="form-control" value="{{ $predio->descripcion }}" readonly>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card: Ubicación (retractil) -->
        <div class="card card-primary">
            <div class="card-header">
                <h5 class="mb-0">
                    <a href="#collapseUbicacion" class="text-white" data-toggle="collapse" aria-expanded="false" aria-controls="collapseUbicacion">
                        <i class="fas fa-map-marker-alt"></i> Ubicación
                    </a>
                </h5>
            </div>
            <div id="collapseUbicacion" class="collapse">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="estadoRepublica">Estado</label>
                            <input type="text" name="estadoRepublica" class="form-control" value="{{ $predio->estadoRepublica }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="municipio">Municipio</label>
                            <input type="text" name="municipio" class="form-control" value="{{ $predio->municipio }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="localidad">Localidad</label>
                            <input type="text" name="localidad" class="form-control" value="{{ $predio->localidad }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card: Tamaño y Lotes (retractil) -->
        <div class="card card-primary">
            <div class="card-header">
                <h5 class="mb-0">
                    <a href="#collapseTamano" class="text-white" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTamano">
                        <i class="fas fa-ruler"></i> Tamaño y Lotes
                    </a>
                </h5>
            </div>
            <div id="collapseTamano" class="collapse">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="hectarias">Hectáreas</label>
                            <input type="text" name="hectarias" class="form-control" value="{{ $predio->hectarias }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="numeroManzanas">Número de Manzanas</label>
                            <input type="text" name="numeroManzanas" class="form-control" value="{{ $predio->numeroManzanas }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="numeroLotes">Número de Lotes</label>
                            <input type="text" name="numeroLotes" class="form-control" value="{{ $predio->numeroLotes }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card: Fecha y Estado (retractil) -->
        <div class="card card-primary">
            <div class="card-header">
                <h5 class="mb-0">
                    <a href="#collapseEstado" class="text-white" data-toggle="collapse" aria-expanded="false" aria-controls="collapseEstado">
                        <i class="fas fa-calendar-alt"></i> Fecha de Inauguración y Estado
                    </a>
                </h5>
            </div>
            <div id="collapseEstado" class="collapse">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="fechaInauguracion">Fecha de Inauguración</label>
                            <input type="text" name="fechaInauguracion" class="form-control"
                                value="{{ \Carbon\Carbon::parse($predio->fechaInauguracion)->format('d-m-Y') }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="activo">Estado</label>
                            <input type="text" name="activo" class="form-control"
                                value="{{ $predio->activo ? 'Activo' : 'Inactivo' }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <a href="{{ route('predios.index') }}" class="btn btn-block bg-gradient-secondary">Regresar</a>

    </div>



@stop

@section('js')
    <script>
        // Iniciar todas las colapsibles cerradas por defecto
        $('.collapse').collapse('hide');
    </script>
@stop
