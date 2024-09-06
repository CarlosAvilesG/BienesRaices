<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory, SoftDeletes;

    // Especificar la tabla si es diferente a la convención plural de Laravel
  //  protected $table = 'clientes';

    // Especificar la clave primaria si es diferente de 'id'
   // protected $primaryKey = 'idCliente';

    // Definir los campos que pueden ser asignados en masa
    protected $fillable = [
        'paterno', 'materno', 'nombre', 'curp', 'rfc', 'ine',
        'direccion', 'direccionEntreCalle', 'codigoPostal',
        'colonia', 'numeroExterior', 'telefonoCasa', 'celular',
        'trabajo', 'trabajoDireccion', 'trabajoTelefono',
        'estadoRepublica', 'municipio', 'localidad',
        'correoElectronico', 'pass', 'usuarioWeb',
        'foto_url', 'fechaRegistro', 'morosidad_activa',
        'monto_deuda_actual', 'ultima_actualizacion_morosidad',
        'idUsuario'
    ];

    // Relación con el modelo Morosos
    public function morosos()
    {
        return $this->hasMany(Moroso::class, 'id');
    }

}
