@extends('adminlte::page')

@section('title', isset($predio) ? 'Editar Predio' : 'Crear Predio')

@section('content_header')
    <h1>{{ isset($predio) ? 'Editar Predio' : 'Crear Predio' }}</h1>
@stop

@section('content')
    <div class="container">

        <!-- Mostrar mensaje de éxito si existe -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Mostrar errores de validación si existen -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- El formulario será el mismo para crear y editar -->
        <form action="{{ isset($predio) ? route('predios.update', $predio->id) : route('predios.store') }}" method="POST">
            @csrf
            @if (isset($predio))
                @method('PUT')
            @endif

            <!-- Botones pegajosos en la parte superior -->
            <div class="sticky-top bg-light py-2 mb-3">
                <div class="d-flex justify-content-end">
                    <!-- Botón de Guardar/Actualizar -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            {{ isset($predio) ? 'Actualizar Predio' : 'Crear Predio' }}
                        </button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </div>
            </div>

            <!-- Card: Información General del Predio -->
            <div class="card card-primary">
                <div class="card-header">
                    <h5>Información General</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Nombre del Predio -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre">Nombre del Predio</label>
                                <input type="text" name="nombre" class="form-control" id="nombre"
                                    value="{{ old('nombre', $predio->nombre ?? '') }}" required>
                            </div>
                        </div>
                        <!-- Descripción del Predio -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <input type="text" name="descripcion" class="form-control" id="descripcion"
                                    value="{{ old('descripcion', $predio->descripcion ?? '') }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card: Ubicación del Predio -->
            <div class="card card-primary">
                <div class="card-header">
                    <h5>Ubicación del Predio</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Estado de la República -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="estadoRepublica">Estado</label>
                                <input type="text" name="estadoRepublica" class="form-control" id="estadoRepublica"
                                    value="{{ old('estadoRepublica', $predio->estadoRepublica ?? '') }}" required>
                            </div>
                        </div>
                        <!-- Municipio -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="municipio">Municipio</label>
                                <input type="text" name="municipio" class="form-control" id="municipio"
                                    value="{{ old('municipio', $predio->municipio ?? '') }}" required>
                            </div>
                        </div>
                        <!-- Localidad -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="localidad">Localidad</label>
                                <input type="text" name="localidad" class="form-control" id="localidad"
                                    value="{{ old('localidad', $predio->localidad ?? '') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Código Postal -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="codigoPostal">Código Postal</label>
                                <input type="text" name="codigoPostal" class="form-control" id="codigoPostal"
                                    value="{{ old('codigoPostal', $predio->codigoPostal ?? '') }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card: Información Técnica -->
            <div class="card card-primary">
                <div class="card-header">
                    <h5>Información Técnica</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Hectáreas -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="hectareas">Hectáreas</label>
                                <input type="number" name="hectareas" class="form-control" id="hectareas"
                                    value="{{ old('hectareas', $predio->hectareas ?? '') }}" required>
                            </div>
                        </div>
                        <!-- Número de Manzanas -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="numeroManzanas">Número de Manzanas</label>
                                <input type="number" name="numeroManzanas" class="form-control" id="numeroManzanas"
                                    value="{{ old('numeroManzanas', $predio->numeroManzanas ?? '') }}" required>
                            </div>
                        </div>
                        <!-- Número de Lotes -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="numeroLotes">Número de Lotes</label>
                                <input type="number" name="numeroLotes" class="form-control" id="numeroLotes"
                                    value="{{ old('numeroLotes', $predio->numeroLotes ?? '') }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card: Escritura del Predio -->
            <div class="card card-primary">
                <div class="card-header">
                    <h5>Escritura del Predio</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Clave Catastral -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="claveCatastral">Clave Catastral</label>
                                <input type="text" name="claveCatastral" class="form-control" id="claveCatastral"
                                    value="{{ old('claveCatastral', $predio->claveCatastral ?? '') }}" required>
                            </div>
                        </div>
                        <!-- Notaría -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="notaria">Notaría</label>
                                <input type="text" name="notaria" class="form-control" id="notaria"
                                    value="{{ old('notaria', $predio->notaria ?? '') }}" required>
                            </div>
                        </div>
                        <!-- Número de Escritura -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="numeroEscritura">Número de Escritura</label>
                                <input type="text" name="numeroEscritura" class="form-control" id="numeroEscritura"
                                    value="{{ old('numeroEscritura', $predio->numeroEscritura ?? '') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Folio de Escritura -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="folioEscritura">Folio de Escritura</label>
                                <input type="text" name="folioEscritura" class="form-control" id="folioEscritura"
                                    value="{{ old('folioEscritura', $predio->folioEscritura ?? '') }}" required>
                            </div>
                        </div>
                        <!-- Volumen de Escritura -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="volumenEscritura">Volumen de Escritura</label>
                                <input type="text" name="volumenEscritura" class="form-control" id="volumenEscritura"
                                    value="{{ old('volumenEscritura', $predio->volumenEscritura ?? '') }}" required>
                            </div>
                        </div>
                        <!-- Fecha de Escritura -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fechaEscritura">Fecha de Escritura</label>
                                <input type="date" name="fechaEscritura" class="form-control" id="fechaEscritura"
                                    value="{{ old('fechaEscritura', $predio->fechaEscritura ?? '') }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card: Coordenadas del Predio -->
            <div class="card card-primary">
                <div class="card-header">
                    <h5>Coordenadas del Predio</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Coordenadas Norte -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="coordenadasNorte">Coordenadas Norte</label>
                                <input type="text" name="coordenadasNorte" class="form-control" id="coordenadasNorte"
                                    value="{{ old('coordenadasNorte', $predio->coordenadasNorte ?? '') }}" required>
                            </div>
                        </div>
                        <!-- Coordenadas Sur -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="coordenadasSur">Coordenadas Sur</label>
                                <input type="text" name="coordenadasSur" class="form-control" id="coordenadasSur"
                                    value="{{ old('coordenadasSur', $predio->coordenadasSur ?? '') }}" required>
                            </div>
                        </div>
                        <!-- Coordenadas Este -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="coordenadasEste">Coordenadas Este</label>
                                <input type="text" name="coordenadasEste" class="form-control" id="coordenadasEste"
                                    value="{{ old('coordenadasEste', $predio->coordenadasEste ?? '') }}" required>
                            </div>
                        </div>
                        <!-- Coordenadas Oeste -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="coordenadasOeste">Coordenadas Oeste</label>
                                <input type="text" name="coordenadasOeste" class="form-control" id="coordenadasOeste"
                                    value="{{ old('coordenadasOeste', $predio->coordenadasOeste ?? '') }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mapa de Google para seleccionar coordenadas -->
            <div class="card card-primary">
                <div class="card-header">
                    <h5>Seleccionar Ubicación en el Mapa</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Mapa de Google -->
                        <div class="col-md-12">
                            <label for="map">Ubicación</label>
                            <div id="map" style="height: 400px;"></div>
                        </div>

                        <!-- Campos ocultos para guardar latitud y longitud -->
                        <input type="hidden" id="latitud" name="latitud" value="{{ old('latitud', $predio->latitud ?? '') }}">
                        <input type="hidden" id="longitud" name="longitud" value="{{ old('longitud', $predio->longitud ?? '') }}">
                    </div>
                </div>
            </div>

            <!-- Card: Estado Activo -->
            <div class="card card-primary">
                <div class="card-header">
                    <h5>Estado del Predio</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="activo">¿Está Activo?</label>
                        <select name="activo" class="form-control">
                            <option value="1" {{ old('activo', $predio->activo ?? 1) == 1 ? 'selected' : '' }}>Sí
                            </option>
                            <option value="0" {{ old('activo', $predio->activo ?? 1) == 0 ? 'selected' : '' }}>No
                            </option>
                        </select>
                    </div>
                </div>
            </div>

        </form>
    </div>
@stop

@section('js')
    <script>
        // Aquí puedes agregar scripts adicionales si necesitas
        function initMap() {
            // Coordenadas predeterminadas (puedes usar alguna coordenada genérica o del predio actual si se está editando)
            let lat = {{ old('latitud', $predio->latitud ?? 24.142) }};
            let lng = {{ old('longitud', $predio->longitud ?? -110.312) }};
            let position = { lat: lat, lng: lng };

            // Crear el mapa
            let map = new google.maps.Map(document.getElementById('map'), {
                center: position,
                zoom: 15
            });

            // Crear el marcador
            let marker = new google.maps.Marker({
                position: position,
                map: map,
                draggable: true // El marcador es arrastrable para que el usuario lo pueda mover
            });

            // Actualizar los campos ocultos cuando el marcador se mueva
            google.maps.event.addListener(marker, 'dragend', function(event) {
                document.getElementById('latitud').value = event.latLng.lat();
                document.getElementById('longitud').value = event.latLng.lng();
            });

            // Si el usuario hace clic en el mapa, mover el marcador y actualizar las coordenadas
            google.maps.event.addListener(map, 'click', function(event) {
                marker.setPosition(event.latLng);
                document.getElementById('latitud').value = event.latLng.lat();
                document.getElementById('longitud').value = event.latLng.lng();
            });
        }
    </script>

    <!-- Cargar la API de Google Maps -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&callback=initMap"></script>

@stop
