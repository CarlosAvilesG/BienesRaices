<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Predio extends Model
{
    use HasFactory, Auditable;

    // Propiedad para almacenar la razón temporal de auditoría
    protected $auditReason;

   // protected $table = 'predio';

  //  protected $primaryKey = 'idPredio';
  

    protected $fillable = [
        'nombre',
        'descripcion',

        'codigoPostal',
        'claveCatastral',
        'notaria',
        'numeroEscritura',
        'folioEscritura',
        'volumenEscritura',
        'fechaEscritura',
        'coordenadasNorte',
        'coordenadasSur',
        'coordenadasEste',
        'coordenadasOeste',

        'latitud',
        'longitud',

        'estadoRepublica',
        'municipio',
        'localidad',
        'hectareas',
        'numeroManzanas',
        'numeroLotes',
        'fechaInauguracion',
        'activo',
    ];

    public static $rules = [
        'nombre' => 'required|string|max:30',
        'descripcion' => 'nullable|string|max:100',

        'codigoPostal' => 'required|string|max:10',
        'claveCatastral' => 'required|string|max:30',
        'Notaria' => 'required|string|max:30',
        'numeroEscritura' => 'required|string|max:30',
        'folioEscritura' => 'required|string|max:30',
        'volumenEscritura' => 'required|string|max:30',
        'fechaEscritura' => 'required|string|max:30',
        'coordenadasNorte' => 'required|string|max:30',
        'coordenadasSur' => 'required|string|max:30',
        'coordenadasEste' => 'required|string|max:30',
        'coordenadasOeste' => 'required|string|max:30',

        'latitud' => 'nullable|numeric',
        'longitud' => 'nullable|numeric',

        'estadoRepublica' => 'required|string|max:30',
        'municipio' => 'required|string|max:30',
        'localidad' => 'required|string|max:30',
        'hectareas' => 'required|integer|min:0',
        'numeroManzanas' => 'required|integer|min:0',
        'numeroLotes' => 'required|integer|min:0',
        'fechaInauguracion' => 'required|date',
        'activo' => 'boolean',
    ];

     // Casts para asegurar que los tipos sean correctos
     protected $casts = [
        'activo' => 'boolean',
        'fechaInauguracion' => 'date',
    ];

}
