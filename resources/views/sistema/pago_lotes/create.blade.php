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

    <div class="row align-items-stretch">
        <div class="col-md-4">
            <div class="card h-100 mb-3">
                <div class="card-header">Detalles del Contrato</div>
                <div class="card-body">
                    <p><strong>Enganche:</strong> {{  $contrato->getEnganceFormateadoAttribute() }} - <strong>Pagado:</strong> {{ $contrato->getTotalEngancheAttribute()  }} </p>

                    <p><strong>Anualidades:</strong> {{$contrato->getNoPagosAnualidadAttribute()}}/{{$contrato->anualidades }} - <strong>Pagado:</strong> {{ $contrato->getTotalAnualidadFormateadoAttribute() }} </p>

                    <p><strong>Convenio de Pago:</strong> {{ $contrato->convenioTemporalidadPago }} a <strong>{{ $contrato->noAnios }}</strong> Años </p>

                    <p><strong>Número de Letras:</strong> {{ $contrato->getNoPagosMensualidadAttribute()}}/{{ $contrato->noLetras }} - <strong>Pagado:</strong>  {{$contrato->getTotalMensualidadFormateadoAttribute()}}   </p>

                    <p><strong>Precio Predio:</strong> {{ $contrato->getPrecioPredioFormateadoAttribute() }}</p>

                    <p> <strong>Total Aboando:</strong>  {{ $contrato->getTotalPagosValidadosFormateadoAttribute() }} - <strong>Pendiente Validar:</strong>  {{$contrato->getTotalPagosPorValidarFormateadoAttribute()}}   </p>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 mb-6">
                <div class="card-header">Detalles del Lote</div>
                <div class="card-body">
                    <p><strong>Predio:</strong> {{ $lote->Predio->nombre }}</p>
                    <p><strong>Manzana:</strong> {{ $lote->manzana }}</p>
                    <p><strong>Lote:</strong> {{ $lote->lote }}</p>
                    <p><strong>Descripción:</strong> {{ $lote->descripcion }}</p>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 mb-3">
                <div class="card-header">Detalles del Cliente</div>
                <div class="card-body">
                    <p><strong>Apellido Paterno:</strong> {{ $cliente->paterno }}</p>
                    <p><strong>Apellido Materno:</strong> {{ $cliente->materno }}</p>
                    <p><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
                    <p><strong>Celular:</strong> {{ $cliente->celular }}</p>
                    <p><strong>Correo Electrónico:</strong> {{ $cliente->correoElectronico }}</p>

                    <p><strong>Referencia:</strong> {{ $cliente->referencias->getNombreCompletoAttribute() }}</p>

                </div>
            </div>
         </div>

    </div>


    <form action="{{ route('pagos-lote.store') }}" method="POST">
        @csrf

        <!-- Campos del Formulario -->
        <div class="row">
            <!-- Motivo del Pago -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="motivo">Motivo del Pago</label>
                    <select name="motivo" id="motivo" class="form-control" required>
                        <option value="">-- Seleccione el motivo --</option>
                        <option value="Enganche">Enganche</option>
                        <option value="Mensualidad">Mensualidad</option>
                        <option value="Anualidad">Anualidad</option>
                    </select>
                </div>
            </div>

            <!-- Tipo de Pago -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tipoPago">Tipo de Pago</label>
                    <select name="tipoPago" id="tipoPago" class="form-control" required>
                        <option value="">-- Seleccione el tipo --</option>
                        <option value="Efectivo">Enganche</option>
                        <option value="Mensualidad">Mensualidad</option>
                        <option value="Anualidad">Anualidad</option>
                    </select>
                 </div>
            </div>

            <!-- Referencia Bancaria -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="referenciaBancaria">Referencia Bancaria</label>
                    <input type="text" name="referenciaBancaria" id="referenciaBancaria" class="form-control" placeholder="Número de referencia bancaria (opcional)">
                </div>
            </div>

            <!-- Monto -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="monto_pago">Monto del Pago</label>
                    <input type="number" step="0.01" name="monto_pago" id="monto_pago" class="form-control" placeholder="Ingrese el monto" required>
                </div>
            </div>

            <!-- Fecha de Pago -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fechaPago">Fecha del Pago</label>
                    <input type="date" name="fechaPago" id="fechaPago" class="form-control" required>
                </div>
            </div>

            <!-- Hora del Pago -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="horaPago">Hora del Pago</label>
                    <input type="time" name="horaPago" id="horaPago" class="form-control" required>
                </div>
            </div>

            <!-- Observaciones -->
            <div class="col-md-12">
                <div class="form-group">
                    <label for="observacion">Observaciones</label>
                    <textarea name="observacion" id="observacion" rows="3" class="form-control" placeholder="Agregue cualquier observación adicional (opcional)"></textarea>
                </div>
            </div>
        </div>

        <!-- Botón de Enviar -->
        <div class="row">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Registrar Pago
                </button>
            </div>
        </div>
    </form>




@endsection




@section('js')
<script>

</script>
@stop
