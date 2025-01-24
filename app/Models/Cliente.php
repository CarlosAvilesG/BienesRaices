<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Auditable;

class Cliente extends Model
{
    use HasFactory, SoftDeletes, Auditable;

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

    // Relación con el modelo ClienteReferencia
    public function referencias()
    {
        return $this->hasMany(ClienteReferencia::class, 'idCliente', 'id'); // Clave foránea: idCliente
    }

    // Propiedad para regresar el nombre completo del cliente
    public function getNombreCompletoAttribute()
    {
        $nombre = $this->nombre ?? ''; // Si es null, usar una cadena vacía
        $paterno = $this->paterno ?? ''; // Si es null, usar una cadena vacía
        $materno = $this->materno ?? ''; // Si es null, usar una cadena vacía

        // Concatenar los valores, eliminando espacios extras
        $nombreCompleto = "$nombre $paterno $materno";

        // Si el nombre completo está vacío, regresar "Sin Referencias"
        return $nombreCompleto !== '' ? $nombreCompleto : 'Sin registro';
    }

}
