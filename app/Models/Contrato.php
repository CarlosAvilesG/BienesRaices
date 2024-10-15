<?php

namespace App\Models;

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
