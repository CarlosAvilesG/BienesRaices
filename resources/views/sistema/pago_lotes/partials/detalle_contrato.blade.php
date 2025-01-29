<div class="row">
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
                    <i class="fas fa-map-marker-alt"></i> Detalles del Lote: {{ $contrato->lote->id }}
                </h3>
            </div>
            <div class="card-body">
                <p><strong><i class="fas fa-home"></i> Predio:</strong> {{ $contrato->lote->Predio->nombre }}</p>
                {{-- <p><strong><i class="fas fa-th"></i> Manzana:</strong> {{ $lote->manzana }} - <strong>Lote:</strong> {{ $lote->lote }}</p> --}}
                <p><strong><i class="fas fa-th"></i> Manzana:</strong> {{ $contrato->lote->manzana }} - <strong>Lote:</strong> {{ $contrato->lote->lote }}</p>

                <p><strong><i class="fas fa-ruler"></i> Superficie:</strong> {{ $contrato->lote->metrosCuadrados }} m<sup>2</sup></p>
                <p><strong><i class="fas fa-file-alt"></i> Descripción:</strong> {{ $contrato->lote->descripcion }}</p>
                <p><strong><i class="fas fa-info-circle"></i> Estatus:</strong> <span class="badge badge-info">{{ $contrato->lote->estatusPago }}</span></p>
            </div>
        </div>
    </div>

    <!-- Detalles del Cliente -->
    <div class="col-md-4">
        <div class="card card-warning shadow h-100 mb-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user"></i> Detalles del Cliente: {{ $contrato->cliente->id }}
                </h3>
            </div>
            <div class="card-body">
                <p><strong><i class="fas fa-user"></i> Nombre:</strong> {{ $contrato->cliente->nombre_completo }}</p>
                <p><strong><i class="fas fa-phone"></i> Celular:</strong> {{ $contrato->cliente->celular }}</p>
                <p><strong><i class="fas fa-envelope"></i> Correo Electrónico:</strong> {{ $contrato->cliente->correoElectronico }}</p>

                <p><strong><i class="fas fa-users"></i> Referencias:</strong></p>
                <ul class="list-group">
                    @forelse ($contrato->cliente->referencias as $referencia)
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
</div>
