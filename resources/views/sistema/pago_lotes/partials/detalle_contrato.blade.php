<div class="row">
    <!-- Detalles del Contrato -->
    <div class="col-md-4">
        <div class="card card-info shadow h-100 mb-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-file-contract"></i> Detalles del Contrato: {{ $contratoActivo->id }}
                </h3>
            </div>
            <div class="card-body">
                <p><strong><i class="fas fa-dollar-sign"></i> Precio Predio:</strong> {{ $contratoActivo->getPrecioPredioFormateadoAttribute() }}</p>

                <p><strong><i class="fas fa-coins"></i> Enganche:</strong>
                    {{  $contratoActivo->getEngancheFormateadoAttribute() }}
                    - <strong>Pagado:</strong> {{ $contratoActivo->getTotalEnganchePagadoFormateadoAttribute() }}
                </p>

                <p><strong><i class="fas fa-calendar-alt"></i> Anualidades:</strong>
                    {{$contratoActivo->getNoPagosAnualidadAttribute()}}/{{$contratoActivo->anualidades }}
                    - <strong>Pagado:</strong> {{ $contratoActivo->getTotalAnualidadPagadasAttribute() }}
                </p>

                <p><strong><i class="fas fa-handshake"></i> Convenio de Pago:</strong>
                    {{ $contratoActivo->convenioTemporalidadPago }} a <strong>{{ $contratoActivo->noAnios }}</strong> Años
                </p>

                <p><strong><i class="fas fa-receipt"></i> No. de Letras:</strong>
                    {{ $contratoActivo->getNoPagosMensualidadPagadoAttribute()}}/{{$contratoActivo->noLetras }}
                    - <strong>Pagado:</strong>  {{$contratoActivo->getTotalMensualidadPagadoFormateadoAttribute()}}
                    - <strong>Pago Minimo:</strong>  {{$contratoActivo->getMontoMensualidadCalculadoFormateadoAttribute()}}
                </p>

                <p><strong><i class="fas fa-check-circle"></i> Total Abonado:</strong>
                    {{ $contratoActivo->getTotalPagosValidadosFormateadoAttribute() }}
                    - <strong>Pendiente Validar:</strong>
                    {{$contratoActivo->getTotalPagosPorValidarFormateadoAttribute()}}
                </p>
            </div>
        </div>
    </div>

    <!-- Detalles del Lote -->
    <div class="col-md-4">
        <div class="card card-success shadow h-100 mb-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-map-marker-alt"></i> Detalles del Lote: {{ $contratoActivo->lote->id }}
                </h3>
            </div>
            <div class="card-body">
                <p><strong><i class="fas fa-home"></i> Predio:</strong> {{ $contratoActivo->lote->Predio->nombre }}</p>
                {{-- <p><strong><i class="fas fa-th"></i> Manzana:</strong> {{ $lote->manzana }} - <strong>Lote:</strong> {{ $lote->lote }}</p> --}}
                <p><strong><i class="fas fa-th"></i> Manzana:</strong> {{ $contratoActivo->lote->manzana }} - <strong>Lote:</strong> {{ $contratoActivo->lote->lote }}</p>

                <p><strong><i class="fas fa-ruler"></i> Superficie:</strong> {{ $contratoActivo->lote->metrosCuadrados }} m<sup>2</sup></p>
                <p><strong><i class="fas fa-file-alt"></i> Descripción:</strong> {{ $contratoActivo->lote->descripcion }}</p>
                <p><strong><i class="fas fa-info-circle"></i> Estatus:</strong> <span class="badge badge-info">{{ $contratoActivo->lote->estatusPago }}</span></p>
            </div>
        </div>
    </div>

    <!-- Detalles del Cliente -->
    <div class="col-md-4">
        <div class="card card-warning shadow h-100 mb-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user"></i> Detalles del Cliente: {{ $contratoActivo->cliente->id }}
                </h3>
            </div>
            <div class="card-body">
                <p><strong><i class="fas fa-user"></i> Nombre:</strong> {{ $contratoActivo->cliente->nombre_completo }}</p>
                <p><strong><i class="fas fa-phone"></i> Celular:</strong> {{ $contratoActivo->cliente->celular }}</p>
                <p><strong><i class="fas fa-envelope"></i> Correo Electrónico:</strong> {{ $contratoActivo->cliente->correoElectronico }}</p>

                <p><strong><i class="fas fa-users"></i> Referencias:</strong></p>
                <ul class="list-group">
                    @forelse ($contratoActivo->cliente->referencias as $referencia)
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
