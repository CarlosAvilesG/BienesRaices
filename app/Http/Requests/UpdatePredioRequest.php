<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePredioRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:30',
            'descripcion' => 'required|string|max:100',

            'codigoPostal' => 'required|string|max:10',
            'claveCatastral' => 'required|string|max:30',
            'notaria' => 'required|string|max:30',
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
           // 'fechaInauguracion' => 'required|date',
            'activo' => 'boolean',
        ];
    }
}

