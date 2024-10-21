@extends('adminlte::page')

@section('title', 'Datos del Cliente')

@section('content_header')
    <h1>Datos del Cliente</h1>
@stop

@section('content')
    <div class="container">


          <!-- Botones pegajosos en la parte superior -->
          <div class="sticky-top bg-light py-2 mb-3">
            <div class="d-flex justify-content-end">

                <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Regresar
                </a>
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



            <!-- Card: Información Personal -->
            <div class="card card-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-user"></i> Información Personal</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="{{ $cliente->nombre }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="paterno">Apellido Paterno</label>
                            <input type="text" name="paterno" class="form-control" value="{{ $cliente->paterno }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="materno">Apellido Materno</label>
                            <input type="text" name="materno" class="form-control" value="{{ $cliente->materno }}" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card: Usuario y Foto -->
            <div class="card card-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-user-circle"></i> Usuario y Foto</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="correoElectronico">Correo Electrónico</label>
                            <input type="email" name="correoElectronico" class="form-control" value="{{ $cliente->correoElectronico }}" required>

                            <label for="pass" class="mt-3">Contraseña</label>
                            <input type="password" name="pass" class="form-control">
                            <small class="form-text text-muted">Dejar en blanco para no cambiar la contraseña.</small>
                        </div>

                        <div class="col-md-6 text-center">
                            <img id="preview" src="{{ $cliente->foto_url ? asset('storage/' . $cliente->foto_url) : asset('images/default-avatar.png') }}" alt="Vista Previa" class="img-thumbnail mb-3" style="max-width: 150px;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card: Identificación (retractil) -->
            <div class="card card-primary">
                <div class="card-header ">
                    <h5 class="mb-0">
                        <a href="#collapseIdentificacion" class="text-white" data-toggle="collapse" aria-expanded="false" aria-controls="collapseIdentificacion">
                            <i class="fas fa-id-card"></i> Identificación
                        </a>
                    </h5>
                </div>
                <div id="collapseIdentificacion" class="collapse">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="curp">CURP</label>
                                <input type="text" name="curp" class="form-control" maxlength="18" value="{{ $cliente->curp }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="rfc">RFC</label>
                                <input type="text" name="rfc" class="form-control" maxlength="13" value="{{ $cliente->rfc }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="ine">INE</label>
                                <input type="text" name="ine" class="form-control" maxlength="13" value="{{ $cliente->ine }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card: Contacto y Dirección (retractil) -->
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="mb-0">
                        <a href="#collapseContacto" class="text-white" data-toggle="collapse" aria-expanded="false" aria-controls="collapseContacto">
                            <i class="fas fa-address-book"></i> Contacto y Dirección
                        </a>
                    </h5>
                </div>
                <div id="collapseContacto" class="collapse">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <label for="direccion">Dirección</label>
                                <input type="text" name="direccion" class="form-control" value="{{ $cliente->direccion }}">
                            </div>
                            <div class="col-md-4">
                                <label for="direccionEntreCalle">Entre Calles</label>
                                <input type="text" name="direccionEntreCalle" class="form-control" value="{{ $cliente->direccionEntreCalle }}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="codigoPostal">Código Postal</label>
                                <input type="text" name="codigoPostal" class="form-control" value="{{ $cliente->codigoPostal }}">
                            </div>
                            <div class="col-md-4">
                                <label for="colonia">Colonia</label>
                                <input type="text" name="colonia" class="form-control" value="{{ $cliente->colonia }}">
                            </div>
                            <div class="col-md-4">
                                <label for="numeroExterior">Número Exterior</label>
                                <input type="text" name="numeroExterior" class="form-control" value="{{ $cliente->numeroExterior }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card: Información de Trabajo (retractil) -->
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="mb-0">
                        <a href="#collapseTrabajo" class="text-white" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTrabajo">
                            <i class="fas fa-briefcase"></i> Información de Trabajo
                        </a>
                    </h5>
                </div>
                <div id="collapseTrabajo" class="collapse">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="trabajo">Trabajo</label>
                                <input type="text" name="trabajo" class="form-control" value="{{ $cliente->trabajo }}">
                            </div>
                            <div class="col-md-5">
                                <label for="trabajoDireccion">Dirección del Trabajo</label>
                                <input type="text" name="trabajoDireccion" class="form-control" value="{{ $cliente->trabajoDireccion }}">
                            </div>
                            <div class="col-md-3">
                                <label for="trabajoTelefono">Teléfono del Trabajo</label>
                                <input type="text" name="trabajoTelefono" class="form-control" value="{{ $cliente->trabajoTelefono }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


    </div>
@stop

@section('js')
    <script>
        // Iniciar todas las colapsibles
        $('.collapse').collapse('hide');
    </script>
@stop
