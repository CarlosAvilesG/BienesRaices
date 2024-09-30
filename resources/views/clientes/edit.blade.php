
@extends('adminlte::page')

@section('title', 'Editar Cliente')

@section('content_header')
    <h1>Editar Cliente</h1>
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


        <form action="{{ route('clientes.update', $cliente) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

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
                                <input type="text" name="nombre" class="form-control" value="{{ $cliente->nombre }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="paterno">Apellido Paterno</label>
                                <input type="text" name="paterno" class="form-control" value="{{ $cliente->paterno }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="materno">Apellido Materno</label>
                                <input type="text" name="materno" class="form-control" value="{{ $cliente->materno }}"
                                    required>
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
                                <input type="text" name="curp" class="form-control" maxlength="18"
                                    value="{{ $cliente->curp }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="rfc">RFC</label>
                                <input type="text" name="rfc" class="form-control" maxlength="13"
                                    value="{{ $cliente->rfc }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ine">INE</label>
                                <input type="text" name="ine" class="form-control" maxlength="13"
                                    value="{{ $cliente->ine }}" required>
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
                                <input type="text" name="direccion" class="form-control"
                                    value="{{ $cliente->direccion }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="direccionEntreCalle">Entre Calles</label>
                                <input type="text" name="direccionEntreCalle" class="form-control"
                                    value="{{ $cliente->direccionEntreCalle }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="codigoPostal">Código Postal</label>
                                <input type="text" name="codigoPostal" class="form-control"
                                    value="{{ $cliente->codigoPostal }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="colonia">Colonia</label>
                                <input type="text" name="colonia" class="form-control" value="{{ $cliente->colonia }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="numeroExterior">Número Exterior</label>
                                <input type="text" name="numeroExterior" class="form-control"
                                    value="{{ $cliente->numeroExterior }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefonoCasa">Teléfono de Casa</label>
                                <input type="text" name="telefonoCasa" class="form-control"
                                    value="{{ $cliente->telefonoCasa }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="celular">Teléfono Celular</label>
                                <input type="text" name="celular" class="form-control"
                                    value="{{ $cliente->celular }}" required>
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
                                <input type="text" name="trabajo" class="form-control"
                                    value="{{ $cliente->trabajo }}">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="trabajoDireccion">Dirección del Trabajo</label>
                                <input type="text" name="trabajoDireccion" class="form-control"
                                    value="{{ $cliente->trabajoDireccion }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="trabajoTelefono">Teléfono del Trabajo</label>
                                <input type="text" name="trabajoTelefono" class="form-control"
                                    value="{{ $cliente->trabajoTelefono }}">
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
                                <input type="email" name="correoElectronico" class="form-control"
                                    value="{{ $cliente->correoElectronico }}" required>
                            </div>
                            <div class="form-group">
                                <label for="pass">Contraseña</label>
                                <input type="password" name="pass" class="form-control" value="">
                                <small class="form-text text-muted">Dejar en blanco para no cambiar la contraseña.</small>
                            </div>
                        </div>
                        <!-- Columna: Foto del Cliente -->
                        <div class="col-md-6">
                            <div class="form-group text-center">
                                <label>Foto del Cliente</label>
                                <!-- Imagen existente o silueta -->
                                <div class="image-upload-container mb-2">
                                    <img id="preview"
                                        src="{{ $cliente->foto_url ? asset('storage/' . $cliente->foto_url) : asset('images/default-avatar.png') }}"
                                        alt="Vista Previa" class="img-thumbnail"
                                        style="max-width: 200px; max-height: 200px;">
                                </div>
                                <!-- Botón para subir imagen -->
                                <div class="custom-file">
                                    <input type="file" name="foto_url" class="custom-file-input" id="foto"
                                        accept="image/*">
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
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@stop

@section('js')
    <script>

// Función para redimensionar la imagen en el frontend antes de subirla
function resizeImage(file, maxWidth, callback) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = new Image();
                img.src = e.target.result;
                img.onload = function () {
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');

                    const ratio = img.width / img.height;
                    canvas.width = maxWidth;
                    canvas.height = maxWidth / ratio;

                    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

                    // Convertir el canvas a Blob con compresión al 80%
                    canvas.toBlob(callback, 'image/jpeg', 0.8);
                };
            };
            reader.readAsDataURL(file);
        }

        // Manejar el evento de cambio del input de archivo para previsualizar y redimensionar la imagen
        document.getElementById('foto').onchange = function (evt) {
            const [file] = evt.target.files;
            if (file) {
                // Redimensionar la imagen antes de previsualizarla
                resizeImage(file, 800, function (resizedBlob) {
                    document.getElementById('preview').src = URL.createObjectURL(resizedBlob);
                    document.getElementById('file-name').textContent = file.name; // Mostrar nombre del archivo

                    // Crear un nuevo archivo de imagen redimensionado y agregarlo al formulario
                    const resizedFile = new File([resizedBlob], file.name, { type: 'image/jpeg' });
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(resizedFile);
                    document.getElementById('foto').files = dataTransfer.files;
                });
            }
        }


        // Mostrar el nombre del archivo cargado
       /* document.getElementById('foto').onchange = function (evt) {
            const [file] = evt.target.files;
            if (file) {
                document.getElementById('preview').src = URL.createObjectURL(file);
                document.getElementById('file-name').textContent = file.name; // Mostrar nombre del archivo
            }
        }*/
    </script>
    @if (session('message'))
        <script>
            $(document).ready(function() {
                let message = '{{ session('message') }}';
                Swal.fire({
                    icon: 'success',
                    title: '¡Actualización exitosa!',
                    text: message,
                    //showConfirmButton: false,
                   // timer: 3000
                });
            });
        </script>
    @endif
@stop
