<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoLote extends Model
{
    use HasFactory;


    // Definir el nombre de la tabla si es diferente al plural del modelo
    protected $table = 'pagos_lote';

    // Permitir asignación masiva para estos campos
    protected $fillable = [
        'idPredio',
        'idLote',
        'folio',
        'idContrato',
        'idCliente',
        'tipoPago',
        'referenciaBancaria',
        'monto',
        'pagoNumero',
        'deudaAnterior',
        'fechaPago',
        'horaPago',
        'idUsuario',
        'observacion',
        'cancelar',
        'idUsuarioCancela',
        'pagoValidado',
        'idUsuarioValidaPago',
        'historico',
    ];

    // Definir las relaciones con otros modelos
    public function predio()
    {
        return $this->belongsTo(Predio::class, 'idPredio');
    }

    public function lote()
    {
        return $this->belongsTo(Lote::class, 'idLote');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'idCliente');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario');
    }

    public function usuarioCancela()
    {
        return $this->belongsTo(User::class, 'idUsuarioCancela');
    }

    public function usuarioValidaPago()
    {
        return $this->belongsTo(User::class, 'idUsuarioValidaPago');
    }
}
