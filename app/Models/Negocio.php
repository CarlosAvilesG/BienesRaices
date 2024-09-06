<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negocio extends Model
{
    use HasFactory;

  //  protected $table = 'negocio';

   // protected $primaryKey = 'idNegocio';

    protected $fillable = [
        'razonSocial',
        'telefono1',
        'telefono2',
        'direccion',
        'propietario',
    ];


}
