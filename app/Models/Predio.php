<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Predio extends Model
{
    use HasFactory;

   // protected $table = 'predio';

  //  protected $primaryKey = 'idPredio';

    protected $fillable = [
        'nombre',
        'descripcion',

        'codigoPostal',
        'claveCatastral',
        'Notaria',
        'numeroEscritura',
        'folioEscritura',
        'volumenEscritura',
        'fechaEscritura',
        'coordinadasNorte',
        'coordinadasSur',
        'coordinadasEste',
        'coordinadasOeste',

        'estadoRepublica',
        'municipio',
        'localidad',
        'hectarias',
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
        'coordinadasNorte' => 'required|string|max:30',
        'coordinadasSur' => 'required|string|max:30',
        'coordinadasEste' => 'required|string|max:30',
        'coordinadasOeste' => 'required|string|max:30',
        
        'estadoRepublica' => 'required|string|max:30',
        'municipio' => 'required|string|max:30',
        'localidad' => 'required|string|max:30',
        'hectarias' => 'required|integer|min:0',
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
