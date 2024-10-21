<?php

namespace App\Models;

use App\Repositories\LoteRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contrato extends Model
{
    use HasFactory, SoftDeletes;

    // Definir el nombre de la tabla si es diferente al plural del modelo
    // protected $table = 'contrato';

    // Definir la clave primaria si no es 'id'
    //  protected $primaryKey = 'idContrato';
    public function setIdentificadorContratoAttribute($value)
    {
        $this->attributes['identificadorContrato'] = strtoupper($value);
    }

    // Permitir asignación masiva para estos campos
    protected $fillable = [
        'identificadorContrato',
        'idCliente',
        'idLote',
        'NoContrato',
        'NoConvenio',
        'NoAnios',
        'NoLetras',
        'PrecioPredio',
        'InteresMoroso',
        'FechaCelebracion',
        'HoraCelebracion',
        'FechaTerminoLetras',
        'ConvenioTemporalidadPago',
        'ConvenioViaPago',
        'Anualidades',
        'PagoAnualidad',
        'Enganche',
        'FechaRegistro',
        'HoraRegistro',
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
            if (!empty($contrato->FechaCelebracion) && \Carbon\Carbon::hasFormat($contrato->FechaCelebracion, 'Y-m-d')) {

                // Verificar que el campo 'NoAnios' sea un número válido mayor que cero
                if (!empty($contrato->NoAnios) && is_numeric($contrato->NoAnios)) {
                    $noAnios = (int) $contrato->NoAnios;

                    // Calcular 'FechaTerminoLetras' sumando los años a la 'FechaCelebracion'
                    $contrato->FechaTerminoLetras = \Carbon\Carbon::parse($contrato->FechaCelebracion)->addYears($noAnios);
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
        static::created(function ($contrato) {
            $loteRepository = new LoteRepository();
            $lote = $loteRepository->show($contrato->idLote);
            $lote->idContrato = $contrato->id;
            $lote->save();
        });

    }




    // Casts para asegurar que los tipos sean correctos
    protected $casts = [
        'PrecioPredio' => 'decimal:2',
        'InteresMoroso' => 'decimal:1',
        'engache' => 'decimal:2',

    ];

    // Definir las relaciones con otros modelos
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'idCliente');
    }

    public function lote()
    {
        return $this->belongsTo(Lote::class, 'idLote');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario');
    }

    public function usuarioCancela()
    {
        return $this->belongsTo(User::class, 'idUsuCancela');
    }
}
