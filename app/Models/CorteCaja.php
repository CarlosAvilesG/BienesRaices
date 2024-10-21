<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Auditable;

class CorteCaja extends Model
{
    use HasFactory, SoftDeletes, Auditable;

     // Definir el nombre de la tabla si es diferente al plural del modelo
     //protected $table = 'corte_caja';

     // Definir la clave primaria si no es 'id'
     //protected $primaryKey = 'idCorteCaja';

     // Permitir asignación masiva para estos campos
     protected $fillable = [
         'fechaInicio',
         'fechaFin',
         'totalIngresosFisicos',
         'totalIngresosBancarios',
         'totalEgresos',
         'totalPrestamos',
         'idUsuario',
     ];

     // Casts para asegurar que los tipos sean correctos
     protected $casts = [
         'totalIngresosFisicos' => 'decimal:2',
         'totalIngresosBancarios' => 'decimal:2',
         'totalEgresos' => 'decimal:2',
         'totalPrestamos' => 'decimal:2',
     ];

     // Relación con el usuario que realiza el corte
     public function usuario()
     {
         return $this->belongsTo(User::class, 'idUsuario');
     }

}
