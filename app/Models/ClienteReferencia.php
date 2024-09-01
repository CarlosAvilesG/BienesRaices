<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteReferencia extends Model
{
    use HasFactory;

    protected $table = 'cliente_referencia'; // Nombre de la tabla

    protected $primaryKey = 'idReferencia'; // Clave primaria personalizada

    protected $fillable = [
        'idCliente',
        'paterno',
        'materno',
        'nombre',
        'telefono',
        'trabajo',
        'trabajoDireccion',
        'trabajoTelefono',
    ];

    // Relación con el modelo Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'idCliente');
    }

}
