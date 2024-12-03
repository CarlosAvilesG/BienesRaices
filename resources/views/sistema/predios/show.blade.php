@extends('adminlte::page')

@section('title', 'Detalles del Predio')

@section('content_header')
    <h1>Detalles del Predio</h1>
@stop

@section('content')
    <div class="container">

         <!-- Botones pegajosos en la parte superior -->
         <div class="sticky-top bg-light py-2 mb-3">
            <div class="d-flex justify-content-end">
                <!-- Botón de Regresar -->
                <div class="form-group">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Regresar</a>
                </div>
            </div>
        </div>

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
                    <div class="row">
                        <div class="col-md-4">
                            <label for="codigoPostal">Código Postal</label>
                            <input type="text" name="codigoPostal" class="form-control" value="{{ $predio->codigoPostal }}" readonly>
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
                            <input type="text" name="hectarias" class="form-control" value="{{ $predio->hectareas }}" readonly>
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

        <!-- Card: Escritura (retractil) -->
        <div class="card card-primary">
            <div class="card-header">
                <h5 class="mb-0">
                    <a href="#collapseEscritura" class="text-white" data-toggle="collapse" aria-expanded="false" aria-controls="collapseEscritura">
                        <i class="fas fa-file-contract"></i> Información de Escritura
                    </a>
                </h5>
            </div>
            <div id="collapseEscritura" class="collapse">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="claveCatastral">Clave Catastral</label>
                            <input type="text" name="claveCatastral" class="form-control" value="{{ $predio->claveCatastral }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="Notaria">Notaría</label>
                            <input type="text" name="Notaria" class="form-control" value="{{ $predio->notaria }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="numeroEscritura">Número de Escritura</label>
                            <input type="text" name="numeroEscritura" class="form-control" value="{{ $predio->numeroEscritura }}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="folioEscritura">Folio de Escritura</label>
                            <input type="text" name="folioEscritura" class="form-control" value="{{ $predio->folioEscritura }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="volumenEscritura">Volumen de Escritura</label>
                            <input type="text" name="volumenEscritura" class="form-control" value="{{ $predio->volumenEscritura }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="fechaEscritura">Fecha de Escritura</label>
                            <input type="text" name="fechaEscritura" class="form-control"
                                value="{{ \Carbon\Carbon::parse($predio->fechaEscritura)->format('d-m-Y') }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card: Coordenadas del Predio (retractil) -->
        <div class="card card-primary">
            <div class="card-header">
                <h5 class="mb-0">
                    <a href="#collapseCoordenadas" class="text-white" data-toggle="collapse" aria-expanded="false" aria-controls="collapseCoordenadas">
                        <i class="fas fa-map"></i> Coordenadas del Predio
                    </a>
                </h5>
            </div>
            <div id="collapseCoordenadas" class="collapse">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="coordenadasNorte">Coordenadas Norte</label>
                            <input type="text" name="coordenadasNorte" class="form-control" value="{{ $predio->coordenadasNorte }}" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="coordenadasSur">Coordenadas Sur</label>
                            <input type="text" name="coordenadasSur" class="form-control" value="{{ $predio->coordenadasSur }}" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="coordenadasEste">Coordenadas Este</label>
                            <input type="text" name="coordenadasEste" class="form-control" value="{{ $predio->coordenadasEste }}" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="coordenadasOeste">Coordenadas Oeste</label>
                            <input type="text" name="coordenadasOeste" class="form-control" value="{{ $predio->coordenadasOeste }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mostrar el mapa con la ubicación guardada google maps -->
        <div class="card card-primary">
            <div class="card-header">
                <h5>Ubicación en el Mapa</h5>
            </div>
            <div class="card-body">
                <div id="map" style="height: 400px;"></div>
            </div>
        </div>

        <!-- Card: Fecha de Inauguración y Estado (retractil) -->
        <div class="card card-primary">
            <div class="card-header">
                <h5 class="mb-0">
                    <a href="#collapseFechaEstado" class="text-white" data-toggle="collapse" aria-expanded="false" aria-controls="collapseFechaEstado">
                        <i class="fas fa-calendar-alt"></i> Fecha de Inauguración y Estado
                    </a>
                </h5>
            </div>
            <div id="collapseFechaEstado" class="collapse">
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

    </div>

@stop

@section('js')
    <script>
        // Iniciar todas las colapsibles cerradas por defecto
        $('.collapse').collapse('hide');
        function initMap() {
            let lat = {{ $predio->latitud }};
            let lng = {{ $predio->longitud }};
            let position = { lat: lat, lng: lng };

            // Crear el mapa
            let map = new google.maps.Map(document.getElementById('map'), {
                center: position,
                zoom: 15
            });

            // Crear el marcador en las coordenadas del predio
            let marker = new google.maps.Marker({
                position: position,
                map: map
            });
        }
    </script>

    <!-- Cargar la API de Google Maps -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&callback=initMap"></script>

@stop
