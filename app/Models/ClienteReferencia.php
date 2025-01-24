<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Auditable;
use PhpParser\Node\Expr\AssignOp\Concat;

class ClienteReferencia extends Model
{
    use SoftDeletes, HasFactory, Auditable;

   // protected $table = 'cliente_referencia'; // Nombre de la tabla

   // protected $primaryKey = 'idReferencia'; // Clave primaria personalizada

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
       // return $this->belongsTo(Cliente::class, 'id');
       return $this->belongsTo(Cliente::class, 'idCliente', 'id'); // Clave foránea: idCliente
    }

    // Propiedad para regresar el nombre completo del cliente
    public function getNombreCompletoAttribute()
    {
        $nombre = $this->nombre ?? ''; // Si es null, usar una cadena vacía
        $paterno = $this->paterno ?? ''; // Si es null, usar una cadena vacía
        $materno = $this->materno ?? ''; // Si es null, usar una cadena vacía

        // Concatenar los valores
        $nombreCompleto = "$nombre  $paterno $materno";

        //$nombreCompleto = Concat ("$nombre $paterno $materno");

        // Si el nombre completo está vacío, regresar "Sin Referencias"
        return $nombreCompleto !== '' ? $nombreCompleto : 'Sin registro';
    }

}
