<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;
      // Definir el nombre de la tabla si es diferente al plural del modelo
      protected $table = 'contrato';

      // Definir la clave primaria si no es 'id'
      protected $primaryKey = 'idContrato';

      // Permitir asignación masiva para estos campos
      protected $fillable = [
          'idCliente',
          'idLote',
          'NoContrato',
          'NoConvenio',
          'NoLetras',
          'PrecioPredio',
          'InteresMoroso',
          'FechaCelebracion',
          'HoraCelebracion',
          'FechaTerminoLetras',
          'ConvenioTemporalidadPago',
          'ConvenioViaPago',
          'FechaRegistro',
          'HoraRegistro',
          'idUsuario',
          'observacion',
          'cancelado',
          'idUsuCancela',
          'CanceladoObservacion',
      ];

      // Casts para asegurar que los tipos sean correctos
      protected $casts = [
          'PrecioPredio' => 'decimal:2',
          'InteresMoroso' => 'decimal:1',
          'cancelado' => 'boolean',
      ];

      // Definir las relaciones con otros modelos
      public function cliente()
      {
          return $this->belongsTo(Cliente::class, 'idCliente');
      }

      public function lote()
      {
          return $this->belongsTo(Lote::class, 'idLote');
      }

      public function usuario()
      {
          return $this->belongsTo(User::class, 'idUsuario');
      }

      public function usuarioCancela()
      {
          return $this->belongsTo(User::class, 'idUsuCancela');
      }
      
}
