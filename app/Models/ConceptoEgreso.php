<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConceptoEgreso extends Model
{
    use HasFactory;


    // Definir el nombre de la tabla si es diferente al plural del modelo
    protected $table = 'concepto_egreso';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'idConcepto';

    // Permitir asignación masiva para estos campos
    protected $fillable = [
        'descripcion',
        'gastoCorriente',
        'requiereDevolucion',
    ];

    // Casts para asegurar que los tipos sean correctos
    protected $casts = [
        'gastoCorriente' => 'boolean',
        'requiereDevolucion' => 'boolean',
    ];
    
}
