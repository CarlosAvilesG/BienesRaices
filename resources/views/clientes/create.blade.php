@extends('adminlte::page')

@section('title', 'Agregar Cliente')

@section('content_header')
    <h1>Agregar Cliente</h1>
@stop

@section('content')
<div class="container">

    <form action="{{ route('cliente.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Card: Información Personal -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Información Personal</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="paterno">Apellido Paterno</label>
                            <input type="text" name="paterno" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="materno">Apellido Materno</label>
                            <input type="text" name="materno" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card: Identificación -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Identificación</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="curp">CURP</label>
                            <input type="text" name="curp" class="form-control" maxlength="18" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="rfc">RFC</label>
                            <input type="text" name="rfc" class="form-control" maxlength="13" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ine">INE</label>
                            <input type="text" name="ine" class="form-control" maxlength="13" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card: Contacto y Dirección -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Contacto y Dirección</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" name="direccion" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="direccionEntreCalle">Entre Calles</label>
                            <input type="text" name="direccionEntreCalle" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="codigoPostal">Código Postal</label>
                            <input type="text" name="codigoPostal" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="colonia">Colonia</label>
                            <input type="text" name="colonia" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="numeroExterior">Número Exterior</label>
                            <input type="text" name="numeroExterior" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telefonoCasa">Teléfono de Casa</label>
                            <input type="text" name="telefonoCasa" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="celular">Teléfono Celular</label>
                            <input type="text" name="celular" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card: Trabajo -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Información de Trabajo</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="trabajo">Trabajo</label>
                            <input type="text" name="trabajo" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="trabajoDireccion">Dirección del Trabajo</label>
                            <input type="text" name="trabajoDireccion" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="trabajoTelefono">Teléfono del Trabajo</label>
                            <input type="text" name="trabajoTelefono" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card: Usuario y Foto -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Usuario y Foto</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Columna: Correo Electrónico y Contraseña -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="correoElectronico">Correo Electrónico</label>
                            <input type="email" name="correoElectronico" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="pass">Contraseña</label>
                            <input type="password" name="pass" class="form-control" required>
                        </div>
                    </div>
                    <!-- Columna: Foto del Cliente -->
                    <div class="col-md-6">
                        <div class="form-group text-center">
                            <label>Foto del Cliente</label>
                            <!-- Imagen por defecto (silueta) -->
                            <div class="image-upload-container mb-2">
                                <img id="preview" src="{{ asset('images/default-avatar.png') }}" alt="Vista Previa"
                                     class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                            </div>
                            <!-- Botón para subir imagen -->
                            <div class="custom-file">
                                <input type="file" name="foto_url" class="custom-file-input" id="foto" accept="image/*">
                                <label class="custom-file-label" for="foto">Seleccionar archivo</label>
                            </div>
                            <!-- Mostrar nombre del archivo cargado -->
                            <small class="form-text text-muted" id="file-name"></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@stop

@section('js')
    <script>
        // Mostrar el nombre del archivo cargado
        document.getElementById('foto').onchange = function (evt) {
            const [file] = evt.target.files;
            if (file) {
                document.getElementById('preview').src = URL.createObjectURL(file);
                document.getElementById('file-name').textContent = file.name; // Mostrar nombre del archivo
            }
        }
    </script>
@stop
