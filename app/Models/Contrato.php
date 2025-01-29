<?php

namespace App\Models;

use App\Repositories\LoteRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Auditable;
use App\Helpers\GeneralHelper;

class Contrato extends Model
{
    use HasFactory, SoftDeletes, Auditable;

    // Propiedad para almacenar la razón temporal de auditoría
    protected $auditReason;



    public function setIdentificadorContratoAttribute($value)
    {
        $this->attributes['identificadorContrato'] = strtoupper($value);
    }

    // Permitir asignación masiva para estos campos
    protected $fillable = [
        'identificadorContrato',
        'idCliente',
        'idLote',
        'noContrato',
        'noConvenio',
        'noAnios',
        'noLetras',
        'precioPredio',
        'interesMoroso',
        'fechaCelebracion',
        'horaCelebracion',
        'fechaTerminoLetras',
        'convenioTemporalidadPago',
        'convenioViaPago',
        'anualidades',
        'pagoAnualidad',
        'enganche',
        'fechaRegistro',
        'horaRegistro',
        'idUsuario',
        'observacion',

       // 'idUsuCancela',
       // 'CanceladoObservacion',
    ];


    protected static function boot()
    {
        parent::boot();

        // EVENTO ANTES DE CREAR UN CONTRATO

        // Evento para calcular FechaTerminoLetras antes de crear el contrato
        static::creating(function ($contrato) {
            // Verificar que el campo 'FechaCelebracion' sea una fecha válida
            if (!empty($contrato->fechaCelebracion) && \Carbon\Carbon::hasFormat($contrato->fechaCelebracion, 'Y-m-d')) {

                // Verificar que el campo 'NoAnios' sea un número válido mayor que cero
                if (!empty($contrato->noAnios) && is_numeric($contrato->noAnios)) {
                    $noAnios = (int) $contrato->noAnios;

                    // Calcular 'FechaTerminoLetras' sumando los años a la 'FechaCelebracion'
                    $contrato->fechaTerminoLetras = \Carbon\Carbon::parse($contrato->fechaCelebracion)->addYears($noAnios);
                } else {
                    // Si 'NoAnios' no es válido, puedes lanzar un error o asignar un valor predeterminado
                   // \Log::error("NoAnios no es válido o está vacío: {$contrato->NoAnios}");
                }
            } else {
                // Si 'FechaCelebracion' no es válida, puedes lanzar un error o hacer un fallback
              //  \Log::error("FechaCelebracion no es válida: {$contrato->FechaCelebracion}");
            }
        });

        // EVENTO DESPUES DE CREAR UN CONTRATO para guardar el id del contrato en la tabla de lotes, sera buscar del repositorio de lotes y actualizar el campo idContrato
        // static::created(function ($contrato) {
        //     $loteRepository = new LoteRepository();
        //     $lote = $loteRepository->show($contrato->idLote);
        //     $lote->idContrato = $contrato->id;
        //     $lote->save();
        // });
        static::created(function ($contrato) {
            // Al crear un contrato, también queremos actualizar el lote relacionado
            $lote = $contrato->lote;

            if ($lote) {
                // Al actualizar el lote, podemos almacenar una razón temporal para la bitácora
                $lote->setAuditReason('Actualización derivada de la creación del contrato con ID ' . $contrato->id);
                $lote->idContrato = $contrato->id;
                $lote->save();
            }
        });

    }

    // Casts para asegurar que los tipos sean correctos
    protected $casts = [
        'precioPredio' => 'decimal:2',
        'interesMoroso' => 'decimal:1',
        'engache' => 'decimal:2',
        'fechaCelebracion' => 'datetime', // Convierte a objeto Carbon

    ];

    // Definir las relaciones con otros modelos
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'idCliente', 'id')->withTrashed(); // ← Esto incluirá clientes eliminados;
    }

    public function lote()
    {
        return $this->belongsTo(Lote::class, 'idLote', 'id');
    }
    public function pago_lote()
    {
        return $this->hasMany(PagoLote::class, 'idContrato', 'id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario', 'id');
    }

    public function usuarioCancela()
    {
        return $this->belongsTo(User::class, 'idUsuCancela');
    }

    // / TODOS PAGOS

    // Propiedad para calcular la suma de de TODOS los pagos validos
    public function getTotalPagosValidadosAttribute()
    {
        return $this->pago_lote()
                ->where('cancelar', 0)       // Solo pagos no cancelados
                ->where('pagoValidado', 1)  // Solo pagos validados
                ->sum('monto');             // Calcular la suma de los montos
    }

    // Propiedad para calcular la suma de TODOS los pagos
    public function getTotalPagosPorValidarAttribute()
    {
        return $this->pago_lote()
                ->where('cancelar', 0)       // Solo pagos no cancelados
                ->where('pagoValidado', 0)  // Solo pagos validados
                ->sum('monto');             // Calcular la suma de los montos
    }

    // propiedad para obtener deuda total
    public function getDeudaTotalAttribute()
    {
        return $this->precioPredio - $this->getTotalPagosValidadosAttribute();
    }

    // / TODOS PAGOS fin

/// Letras

    // Propiedad para calcular letras pagadas
    public function getLetrasValidadasAttribute()
    {
        return $this->pago_lote()
                ->where('cancelar', 0)       // Solo pagos no cancelados
                ->where('pagoValidado', 1)  // Solo pagos validados
                ->where('motivo', 'Mensualidad')  // Solo pagos validados
                ->count();             // Contar los registros
    }
    // Propiedad para calcular letras pendientes
    public function getLetrasPendientesAttribute()
    {
        return max(($this->noLetras ?? 0) - ($this->letras_validadas ?? 0), 0);
    }
    // Propiedad para calcular ultima letra pagada de mensualidad
    public function getUltimaLetraPagadaAttribute()
    {
        return $this->pago_lote()
                ->where('cancelar', 0)       // Solo pagos no cancelados
                ->where('pagoValidado', 1)  // Solo pagos validados
                ->where('motivo', 'Mensualidad')  // Solo pagos validados
                ->max('pagoNumero');             // Calcular la suma de los montos
    }
    // propiedad para obtener letra proxima a pagar de mensaulidades
    public function getLetraProximaPagarAttribute()
    {
        return $this->getUltimaLetraPagadaAttribute() + 1;
    }
/// Letras FIN

//Enganche
        // Propiedad para calcular enganche pagadas
    public function getTotalEnganchePagadoAttribute()
    {
        return $this->pago_lote
                ? $this->pago_lote
                    ->where('cancelar', 0)
                    ->where('pagoValidado', 1)
                    ->where('motivo', 'Enganche')
                    ->sum('monto')
                : 0;
    }
    public function getTotalEnganchePagadoFormateadoAttribute()
    {
        return  GeneralHelper::convertirNumeroAMoneda($this->getTotalEnganchePagadoAttribute());
    }

    // Propiedad para calcular enganche pagadas
    public function getNoPagosEngancheAttribute()
    {
        return $this->pago_lote()
                ->where('cancelar', 0)       // Solo pagos no cancelados
                ->where('pagoValidado', 1)  // Solo pagos validados
                ->where('motivo', 'Enganche')  // Solo pagos validados
                ->count();             // Contar los registros
    }

//Enganche FIN

// Anualidad
    // Propiedad para calcular Anualidad pagadas
    public function getTotalAnualidadPagadasAttribute()
    {
        return $this->pago_lote()
                ->where('cancelar', 0)       // Solo pagos no cancelados
                ->where('pagoValidado', 1)  // Solo pagos validados
                ->where('motivo', 'Anualidad')  // Solo pagos validados
                ->sum('monto');              // Calcular la suma de los montos
    }
    public function getTotalAnualidadFormateadoAttribute()
    {
        return  GeneralHelper::convertirNumeroAMoneda($this->getTotalAnualidadAttribute());
    }
     // Propiedad para calcular Anualidad pagadas
     public function getNoPagosAnualidadAttribute()
     {
         return $this->pago_lote()
                 ->where('cancelar', 0)       // Solo pagos no cancelados
                 ->where('pagoValidado', 1)  // Solo pagos validados
                 ->where('motivo', 'Anualidad')  // Solo pagos validados
                 ->count();             // Contar los registros
     }

// Anualidad FIN

// Mensualidad
    // Propiedad para calcular Mensualidad pagadas
    public function getTotalMensualidadPagadoAttribute()
    {
        return $this->pago_lote()
                ->where('cancelar', 0)       // Solo pagos no cancelados
                ->where('pagoValidado', 1)  // Solo pagos validados
                ->where('motivo', 'Mensualidad')  // Solo pagos validados
                ->sum('monto');            // Calcular la suma de los montos
    }
    public function getTotalMensualidadPagadoFormateadoAttribute()
    {
        return  GeneralHelper::convertirNumeroAMoneda($this->getTotalMensualidadPagadoAttribute());
    }

     // Propiedad para calcular Mensualidad pagadas
     public function getNoPagosMensualidadPagadoAttribute()
     {
         return $this->pago_lote()
                 ->where('cancelar', 0)       // Solo pagos no cancelados
                 ->where('pagoValidado', 1)  // Solo pagos validados
                 ->where('motivo', 'Mensualidad')  // Solo pagos validados
                 ->count();             // Contar los registros
     }
// Mensualidad FIN

// Valores Formateados
     public function getPrecioPredioFormateadoAttribute()
    {
        return GeneralHelper::convertirNumeroAMoneda($this->precioPredio);
    }
    public function getEngancheFormateadoAttribute()
    {
        return GeneralHelper::convertirNumeroAMoneda($this->enganche);
    }
    public function getTotalPagosPorValidarFormateadoAttribute()
    {
        return  GeneralHelper::convertirNumeroAMoneda($this->getTotalPagosPorValidarAttribute());
    }
    public function getTotalPagosValidadosFormateadoAttribute()
    {
        return  GeneralHelper::convertirNumeroAMoneda($this->getTotalPagosValidadosAttribute());
    }
    public function getMontoMensualidadCalculadoFormateadoAttribute()
    {
        return GeneralHelper::convertirNumeroAMoneda($this->calcularMontoPagoMensual());
    }
// Valores Formateados FIN

// Calcular saldos
    // Propiedad para calcular el saldo total
    public function getCalcularSaldoPendienteTotalAttribute()
    {
        return $this->precioPredio - $this->getTotalPagosValidadosAttribute();
    }


    // Método para calcular el monto del pago - sin engance y anualidades
    private function calcularMontoPagoMensual()
    {
        $precioPredio = $this->precioPredio;

        $enganche = $this->enganche ?? 0;
         //  $enganchePagado = $this->getTotalEnganchePagadoAttribute();

        $pagoAnualidad = $this->pagoAnualidad ?? 0;
        //    $pagoAnualidadPagado = $this->getTotalAnualidadPagadoAttribute();

        $anualidades = $this->anualidades ?? 0;
         //     $noAnios = $this->noAnios;
        $noLetras = $this->noLetras;
        $noLetrasPagadas = $this->getLetrasValidadasAttribute();

        $totalMensualidadesPagadas = $this->getTotalMensualidadPagadoAttribute();

       // $SaltoPendiente = $this->getCalcularSaldoPendienteTotalAttribute();

        $TotalBrutoMensual = ($precioPredio - ($enganche + ($pagoAnualidad * $anualidades))) ;


        $SaldoRealPendienteMensual = ($TotalBrutoMensual  - $totalMensualidadesPagadas ) / ($noLetras - $noLetrasPagadas);

      //  dd($TotalBrutoMensual, $precioPredio, $enganche, $pagoAnualidad , $noLetras, $anualidades, $noLetrasPagadas , $totalMensualidadesPagadas, $SaldoRealPendienteMensual);

        return $SaldoRealPendienteMensual;
    }
    public function getMontoMensualidadCalculadoAttribute()
    {
        return $this->calcularMontoPagoMensual();
    }

    // calcular mes y año de la mensaudlidad basado en pagoNumero , segun la tabla de amortizacion de la mensualidad
    public function getMesAnioMensualidadAttribute()
    {
        $meses = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio',
            7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];

        $pagoNumero = $this->getUltimaLetraPagadaAttribute();
        $anio = $this->fechaCelebracion->year;
        $mes = $this->fechaCelebracion->month;

        $mesesPagados = $pagoNumero % 12;
        $aniosPagados = floor($pagoNumero / 12);

        $mes = $mes + $mesesPagados;
        if ($mes > 12) {
            $mes = $mes - 12;
            $anio++;
        }

        return "{$meses[$mes]} de $anio";
    }


// Calcular saldos fin

}
