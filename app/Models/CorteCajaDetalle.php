<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Auditable;

class CorteCajaDetalle extends Model
{
    use HasFactory, SoftDeletes, Auditable;


    // Definir el nombre de la tabla si es diferente al plural del modelo
    //protected $table = 'corte_caja_detalle';

    // Permitir asignación masiva para estos campos
    protected $fillable = [
        'idCorteCaja',
        'idPagoLote',
        'idEgreso',
        'monto',
        'tipoMovimiento',
    ];

    // Relación con CorteCaja
    public function corteCaja()
    {
        return $this->belongsTo(CorteCaja::class, 'idCorteCaja');
    }

    // Relación con PagoLote
    public function pagoLote()
    {
        return $this->belongsTo(PagoLote::class, 'idPagoLote');
    }

    // Relación con Egreso
    public function egreso()
    {
        return $this->belongsTo(Egreso::class, 'idEgreso');
    }


}
