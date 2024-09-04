<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FraseEtica extends Model
{
    use HasFactory;

     // Definir el nombre de la tabla si es diferente al plural del modelo
     protected $table = 'fraseseticas';

     // Definir la clave primaria si no es 'id'
     protected $primaryKey = 'idFrase';

     // Permitir asignación masiva para estos campos
     protected $fillable = [
         'frase',
         'autor',
     ];
     
}
