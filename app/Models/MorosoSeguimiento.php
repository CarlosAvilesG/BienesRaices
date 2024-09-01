<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MorosoSeguimiento extends Model
{
    use HasFactory;


// Especificar la tabla si es diferente a la convención plural de Laravel
    protected $table = 'morosos_seguimiento';

    // Definir los campos que pueden ser asignados en masa
    protected $fillable = [
        'idMoroso', 'fecha_contacto', 'medio_contacto',
        'detalle_contacto', 'acuerdo', 'idUsuario'
    ];

    // Relación con el modelo Moroso
    public function moroso()
    {
        return $this->belongsTo(Moroso::class, 'idMoroso');
    }

    // Relación con el modelo Usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario');
    }


}
