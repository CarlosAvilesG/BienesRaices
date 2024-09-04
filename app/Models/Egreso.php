<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egreso extends Model
{
    use HasFactory;


    // Definir el nombre de la tabla si es diferente al plural del modelo
    protected $table = 'egresos';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'idEgresos';

    // Permitir asignación masiva para estos campos
    protected $fillable = [
        'idConcepto',
        'descripcion',
        'monto',
        'idUsuarioRecibe',
        'fecha',
        'hora',
        'idUsuario',
        'supervisado',
        'idUsuSupervisa',
        'cancelado',
        'idUsuCancela',
        'pendienteDevolucion',
        'montoDevuelto',
        'fechaDevolucion',
        'idUsuarioDevuelve',
    ];

    // Casts para asegurar que los tipos sean correctos
    protected $casts = [
        'monto' => 'decimal:2',
        'supervisado' => 'boolean',
        'cancelado' => 'boolean',
        'pendienteDevolucion' => 'boolean',
        'montoDevuelto' => 'decimal:2',
    ];

    // Relación con ConceptoEgreso
    public function concepto()
    {
        return $this->belongsTo(ConceptoEgreso::class, 'idConcepto');
    }

    // Relación con el usuario que recibe el dinero
    public function usuarioRecibe()
    {
        return $this->belongsTo(User::class, 'idUsuarioRecibe');
    }

    // Relación con el usuario que registra el egreso
    public function usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario');
    }

    // Relación con el usuario que supervisa el egreso
    public function usuarioSupervisa()
    {
        return $this->belongsTo(User::class, 'idUsuSupervisa');
    }

    // Relación con el usuario que cancela el egreso
    public function usuarioCancela()
    {
        return $this->belongsTo(User::class, 'idUsuCancela');
    }

    // Relación con el usuario que realiza la devolución
    public function usuarioDevuelve()
    {
        return $this->belongsTo(User::class, 'idUsuarioDevuelve');
    }
}
