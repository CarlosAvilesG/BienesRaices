@extends('adminlte::page')

@section('title', 'Pagos de Lotes')

@section('content_header')
    <h1>Pagos de Lotes</h1>
@stop


@section('content')

    <!-- Mensaje de éxito si existe -->
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Errores de validación si existen -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    @include('sistema.pago_lotes.partials.detalle_contrato')
    {{-- <div class="row">
        <!-- Detalles del Contrato -->
        <div class="col-md-4">
            <div class="card card-info shadow h-100 mb-3">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-file-contract"></i> Detalles del Contrato: {{ $contrato->id }}
                    </h3>
                </div>
                <div class="card-body">
                    <p><strong><i class="fas fa-dollar-sign"></i> Precio Predio:</strong> {{ $contrato->getPrecioPredioFormateadoAttribute() }}</p>

                    <p><strong><i class="fas fa-coins"></i> Enganche:</strong>
                        {{  $contrato->getEngancheFormateadoAttribute() }}
                        - <strong>Pagado:</strong> {{ $contrato->getTotalEnganchePagadoFormateadoAttribute() }}
                    </p>

                    <p><strong><i class="fas fa-calendar-alt"></i> Anualidades:</strong>
                        {{$contrato->getNoPagosAnualidadAttribute()}}/{{$contrato->anualidades }}
                        - <strong>Pagado:</strong> {{ $contrato->getTotalAnualidadPagadasAttribute() }}
                    </p>

                    <p><strong><i class="fas fa-handshake"></i> Convenio de Pago:</strong>
                        {{ $contrato->convenioTemporalidadPago }} a <strong>{{ $contrato->noAnios }}</strong> Años
                    </p>

                    <p><strong><i class="fas fa-receipt"></i> No. de Letras:</strong>
                        {{ $contrato->getNoPagosMensualidadPagadoAttribute()}}/{{$contrato->noLetras }}
                        - <strong>Pagado:</strong>  {{$contrato->getTotalMensualidadPagadoFormateadoAttribute()}}
                        - <strong>Pago Minimo:</strong>  {{$contrato->getMontoMensualidadCalculadoFormateadoAttribute()}}
                    </p>

                    <p><strong><i class="fas fa-check-circle"></i> Total Abonado:</strong>
                        {{ $contrato->getTotalPagosValidadosFormateadoAttribute() }}
                        - <strong>Pendiente Validar:</strong>
                        {{$contrato->getTotalPagosPorValidarFormateadoAttribute()}}
                    </p>
                </div>
            </div>
        </div>

        <!-- Detalles del Lote -->
        <div class="col-md-4">
            <div class="card card-success shadow h-100 mb-3">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-map-marker-alt"></i> Detalles del Lote: {{ $lote->id }}
                    </h3>
                </div>
                <div class="card-body">
                    <p><strong><i class="fas fa-home"></i> Predio:</strong> {{ $lote->Predio->nombre }}</p>
                    <p><strong><i class="fas fa-th"></i> Manzana:</strong> {{ $lote->manzana }} - <strong>Lote:</strong> {{ $lote->lote }}</p>
                    <p><strong><i class="fas fa-ruler"></i> Superficie:</strong> {{ $lote->metrosCuadrados }} m<sup>2</sup></p>
                    <p><strong><i class="fas fa-file-alt"></i> Descripción:</strong> {{ $lote->descripcion }}</p>
                    <p><strong><i class="fas fa-info-circle"></i> Estatus:</strong> <span class="badge badge-info">{{ $lote->estatusPago }}</span></p>
                </div>
            </div>
        </div>

        <!-- Detalles del Cliente -->
        <div class="col-md-4">
            <div class="card card-warning shadow h-100 mb-3">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-user"></i> Detalles del Cliente: {{ $cliente->id }}
                    </h3>
                </div>
                <div class="card-body">
                    <p><strong><i class="fas fa-user"></i> Nombre:</strong> {{ $cliente->nombre_completo }}</p>
                    <p><strong><i class="fas fa-phone"></i> Celular:</strong> {{ $cliente->celular }}</p>
                    <p><strong><i class="fas fa-envelope"></i> Correo Electrónico:</strong> {{ $cliente->correoElectronico }}</p>

                    <p><strong><i class="fas fa-users"></i> Referencias:</strong></p>
                    <ul class="list-group">
                        @forelse ($cliente->referencias as $referencia)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $referencia->nombre_completo }}
                                <span class="badge badge-primary badge-pill"><i class="fas fa-user-check"></i></span>
                            </li>
                        @empty
                            <li class="list-group-item">Sin registro</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div> --}}



    <div class="card card-primary shadow">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-hand-holding-usd"></i> Registro de Pago</h3>
        </div>

        <form action="{{ route('pagos-lote.store') }}" method="POST">
            @csrf

            <!-- Campos ocultos -->
            <input type="hidden" name="idContrato" value="{{ $contrato->id }}">
            <input type="hidden" name="idPredio" value="{{ $lote->idPredio }}">
            <input type="hidden" name="idLote" value="{{ $lote->id }}">
            <input type="hidden" name="idCliente" value="{{ $cliente->id }}">
            <input type="hidden" name="pagoNumero" value="{{ $contrato->getLetraProximaPagarAttribute() }}">
            <input type="hidden" name="deudaAnterior" value="{{ $contrato->getDeudaTotalAttribute() }}">
            <input type="hidden" name="idUsuario" value="{{ auth()->id() }}">

            <div class="card-body">
                <div class="row">
                    {{-- Ingresar el Folio externo --}}
                    <div class="col-md-3">
                        <div class="form-group
                            @error('folioExterno') is-invalid @enderror">
                            <label for="folioExterno"><i class="fas fa-barcode"></i> Folio Externo</label>
                            <input
                                type="text"
                                name="folioExterno"
                                id="folioExterno"
                                class="form-control"
                                placeholder="Ingrese el folio externo (opcional)">
                            @error('folioExterno')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                      <!-- Fecha de Pago -->
                      <div class="col-md-3">
                        <div class="form-group">
                            <label for="fechaPago"><i class="fas fa-calendar-day"></i> Fecha del Pago</label>
                            <input
                                type="date"
                                name="fechaPago"
                                id="fechaPago"
                                class="form-control"
                                value="{{ old('fechaPago', $fechaActual) }}"
                                required>
                        </div>
                    </div>

                    <!-- Hora del Pago -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="horaPago"><i class="fas fa-clock"></i> Hora del Pago</label>
                            <input
                                type="time"
                                name="horaPago"
                                id="horaPago"
                                class="form-control"
                                value="{{ old('horaPago', $horaActual) }}"
                                required>
                        </div>
                    </div>


                </div>


                <div class="row">
                      <!-- Motivo del Pago -->
                      <div class="col-md-3">
                        <div class="form-group">
                            <label for="motivo"><i class="fas fa-question-circle"></i> Motivo del Pago</label>
                            <select name="motivo" id="motivo" class="form-control @error('motivo') is-invalid @enderror" required>
                                <option value="">-- Seleccione el motivo --</option>
                                <option value="Enganche">Enganche</option>
                                <option value="Mensualidad">Mensualidad</option>
                                <option value="Anualidad">Anualidad</option>
                            </select>
                            @error('motivo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Tipo de Pago -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tipoPago"><i class="fas fa-credit-card"></i> Tipo de Pago</label>
                            <select name="tipoPago" id="tipoPago" class="form-control @error('tipoPago') is-invalid @enderror" required>
                                <option value="">-- Seleccione el tipo --</option>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Cheque">Cheque</option>
                                <option value="Transferencia">Transferencia</option>
                            </select>
                            @error('tipoPago')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Monto del Pago -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="monto"><i class="fas fa-dollar-sign"></i> Monto del Pago</label>
                            <input
                                step="0.01"
                                name="monto"
                                id="monto"
                                class="form-control @error('monto') is-invalid @enderror"
                                value="{{ old('monto', $contrato->getMontoMensualidadCalculadoFormateadoAttribute()) }}"
                                placeholder="Ingrese el monto"
                                required
                                autofocus>
                            @error('monto')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- Referencia Bancaria -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="referenciaBancaria"><i class="fas fa-receipt"></i> Referencia Bancaria</label>
                            <input
                                type="text"
                                name="referenciaBancaria"
                                id="referenciaBancaria"
                                class="form-control"
                                placeholder="Número de referencia bancaria (opcional)">
                        </div>
                    </div>


                </div>

                <!-- Observaciones -->
                <div class="form-group">
                    <label for="observacion"><i class="fas fa-comment-alt"></i> Observaciones</label>
                    <textarea name="observacion" id="observacion" rows="3" class="form-control" placeholder="Agregue cualquier observación adicional (opcional)"></textarea>
                </div>
            </div>

            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save"></i> Registrar Pago
                </button>
            </div>
        </form>
    </div>



@endsection




@section('js')
<script>

</script>
@stop
