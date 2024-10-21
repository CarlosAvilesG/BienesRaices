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
                                <input type="text" name="nombre" class="form-control"
                                    value="{{ old('nombre', $predio->nombre ?? '') }}" required>
                            </div>
                        </div>
                        <!-- Descripción del Predio -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <input type="text" name="descripcion" class="form-control"
                                    value="{{ old('descripcion', $predio->descripcion ?? '') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Estado de la República -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="estadoRepublica">Estado</label>
                                <input type="text" name="estadoRepublica" class="form-control"
                                    value="{{ old('estadoRepublica', $predio->estadoRepublica ?? '') }}" required>
                            </div>
                        </div>
                        <!-- Municipio -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="municipio">Municipio</label>
                                <input type="text" name="municipio" class="form-control"
                                    value="{{ old('municipio', $predio->municipio ?? '') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Localidad -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="localidad">Localidad</label>
                                <input type="text" name="localidad" class="form-control"
                                    value="{{ old('localidad', $predio->localidad ?? '') }}" required>
                            </div>
                        </div>
                        <!-- Fecha de Inauguración -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fechaInauguracion">Fecha de Inauguración</label>
                                <input type="date" name="fechaInauguracion" class="form-control"
                                    value="{{ old('fechaInauguracion', $predio->fechaInauguracion ?? '') }}" required>
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
                                <label for="hectarias">Hectáreas</label>
                                <input type="number" name="hectarias" class="form-control"
                                    value="{{ old('hectarias', $predio->hectarias ?? '') }}" required>
                            </div>
                        </div>
                        <!-- Número de Manzanas -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="numeroManzanas">Número de Manzanas</label>
                                <input type="number" name="numeroManzanas" class="form-control"
                                    value="{{ old('numeroManzanas', $predio->numeroManzanas ?? '') }}" required>
                            </div>
                        </div>
                        <!-- Número de Lotes -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="numeroLotes">Número de Lotes</label>
                                <input type="number" name="numeroLotes" class="form-control"
                                    value="{{ old('numeroLotes', $predio->numeroLotes ?? '') }}" required>
                            </div>
                        </div>
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

            {{-- <!-- Botón de Guardar/Actualizar -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    {{ isset($predio) ? 'Actualizar Predio' : 'Crear Predio' }}
                </button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
            </div> --}}
        </form>
    </div>
@stop

@section('js')
    <script>
        // Aquí puedes agregar scripts adicionales si necesitas
    </script>
@stop
