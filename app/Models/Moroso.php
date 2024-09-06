<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Moroso extends Model
{
    use HasFactory;

    // Especificar la tabla si es diferente a la convención plural de Laravel
  //  protected $table = 'morosos';

    // Definir los campos que pueden ser asignados en masa
    protected $fillable = [
        'idCliente', 'montoDeuda', 'activo',
        'fecha_inicio', 'fecha_resolucion'
    ];

    // Relación con el modelo Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'idCliente');
    }

    // Relación con el modelo MorososSeguimiento
    public function seguimientos()
    {
        return $this->hasMany(MorosoSeguimiento::class, 'idMoroso');
    }
}
