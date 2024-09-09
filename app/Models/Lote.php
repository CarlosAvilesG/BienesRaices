<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    use HasFactory;

       // Definir el nombre de la tabla si es diferente al plural del modelo
     //  protected $table = 'lotes';

       // Definir la clave primaria si no es 'id'
     //  protected $primaryKey = 'idLote';

       // Permitir asignación masiva para estos campos
       protected $fillable = [
           'idPredio',
           'manzana',
           'lote',
           'descripcion',
           'regular',
           'donacion',
           'loteComercial',
           'loteReparable',
           'loteReparableObs',
           'inhabilitado',
           'metrosFrente',
           'metrosAtras',
           'metrosDerecho',
           'metrosIzquierda',
           'metrosCuadrados',
           'precio',
           'plazoMeses',
           'pagoMensual',
           'estatusPago',
       ];

       // Casts para asegurar que los tipos sean correctos
       protected $casts = [
           'regular' => 'boolean',
           'donacion' => 'boolean',
           'loteComercial' => 'boolean',
           'inhabilitado' => 'boolean',
           'metrosFrente' => 'decimal:2',
           'metrosAtras' => 'decimal:2',
           'metrosDerecho' => 'decimal:2',
           'metrosIzquierda' => 'decimal:2',
           'metrosCuadrados' => 'decimal:2',
           'precio' => 'decimal:2',
           'pagoMensual' => 'decimal:2',
           'estatusPago' => 'string',
       ];

       // Relación con Predio (Muchos a Uno)
       public function predio()
       {
           return $this->belongsTo(Predio::class, 'idPredio');
       }

        // Relación con PagoLote (Uno a Muchos)
        public function pagos()
        {
            return $this->hasMany(PagoLote::class, 'idLote');
        }

       // Relación con LoteFoto (Uno a Muchos)
       public function fotos()
       {
           return $this->hasMany(LoteFoto::class, 'idLote');
       }
}
