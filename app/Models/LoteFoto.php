<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoteFoto extends Model
{
    use HasFactory;

  // Definir el nombre de la tabla si es diferente al plural del modelo
  //protected $table = 'lote_fotos';

  // Permitir asignación masiva para estos campos
  protected $fillable = [
      'idLote',
      'foto_url',
  ];

  // Relación con Lote (Muchos a Uno)
  public function lote()
  {
      return $this->belongsTo(Lote::class, 'idLote');
  }
}
