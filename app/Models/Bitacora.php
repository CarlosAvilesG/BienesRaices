<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    use HasFactory;


     // Definir el nombre de la tabla si es diferente al plural del modelo
     //protected $table = 'bitacora';

     // Permitir asignación masiva para estos campos
     protected $fillable = [
         'fecha',
         'usuario',
         'tabla',
         'tipoOperacion',
         'campoLlave',
         'descripcion',
         'ip',
         'user_agent',
     ];

     // Relación con el usuario que realizó la acción
     public function user()
     {
         return $this->belongsTo(User::class, 'usuario');
     }

}
