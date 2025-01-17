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

    ];

    // Definir las relaciones con otros modelos
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'idCliente', 'id');
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

    // Propiedad para calcular la suma de los pagos validos
    public function getTotalPagosValidadosAttribute()
    {
        return $this->pago_lote()
                ->where('cancelar', 0)       // Solo pagos no cancelados
                ->where('pagoValidado', 1)  // Solo pagos validados
                ->sum('monto');             // Calcular la suma de los montos
    }
    public function getTotalPagosValidadosFormateadoAttribute()
    {
        return  GeneralHelper::convertirNumeroAMoneda($this->getTotalPagosValidadosAttribute());
    }
    // Propiedad para calcular la suma de los pagos
    public function getTotalPagosPorValidarAttribute()
    {
        return $this->pago_lote()
                ->where('cancelar', 0)       // Solo pagos no cancelados
                ->where('pagoValidado', 0)  // Solo pagos validados
                ->sum('monto');             // Calcular la suma de los montos
    }
    public function getTotalPagosPorValidarFormateadoAttribute()
    {
        return  GeneralHelper::convertirNumeroAMoneda($this->getTotalPagosPorValidarAttribute());
    }

    // Propiedad para calcular letras pagadas
    public function getLetrasValidadasAttribute()
    {
        return $this->pago_lote()
                ->where('cancelar', 0)       // Solo pagos no cancelados
                ->where('pagoValidado', 1)  // Solo pagos validados
                ->count();             // Contar los registros
    }
    // Propiedad para calcular letras pendientes
    public function getLetrasPendientesAttribute()
    {
        return max(($this->noLetras ?? 0) - ($this->letras_validadas ?? 0), 0);
    }
        // Propiedad para calcular enganche pagadas
    public function getTotalEngancheAttribute()
    {
        return $this->pago_lote
                ? $this->pago_lote
                    ->where('cancelar', 0)
                    ->where('pagoValidado', 1)
                    ->where('motivo', 'Enganche')
                    ->sum('monto')
                : 0;
    }
    public function getTotalEngancheFormateadoAttribute()
    {
        return  GeneralHelper::convertirNumeroAMoneda($this->getTotalEngancheAttribute());
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
    // Propiedad para calcular Anualidad pagadas
    public function getTotalAnualidadAttribute()
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
    // Propiedad para calcular Mensualidad pagadas
    public function getTotalMensualidadAttribute()
    {
        return $this->pago_lote()
                ->where('cancelar', 0)       // Solo pagos no cancelados
                ->where('pagoValidado', 1)  // Solo pagos validados
                ->where('motivo', 'Mensualidad')  // Solo pagos validados
                ->sum('monto');            // Calcular la suma de los montos
    }
    public function getTotalMensualidadFormateadoAttribute()
    {
        return  GeneralHelper::convertirNumeroAMoneda($this->getTotalMensualidadAttribute());
    }

     // Propiedad para calcular Mensualidad pagadas
     public function getNoPagosMensualidadAttribute()
     {
         return $this->pago_lote()
                 ->where('cancelar', 0)       // Solo pagos no cancelados
                 ->where('pagoValidado', 1)  // Solo pagos validados
                 ->where('motivo', 'Mensualidad')  // Solo pagos validados
                 ->count();             // Contar los registros
     }

     public function getPrecioPredioFormateadoAttribute()
    {
        return GeneralHelper::convertirNumeroAMoneda($this->precioPredio);
    }
    public function getEnganceFormateadoAttribute()
    {
        return GeneralHelper::convertirNumeroAMoneda($this->enganche);
    }


}
