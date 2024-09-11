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
            'estadoRepublica' => 'required|string|max:30',
            'municipio' => 'required|string|max:30',
            'localidad' => 'required|string|max:30',
            'hectarias' => 'required|integer|min:0',
            'numeroManzanas' => 'required|integer|min:0',
            'numeroLotes' => 'required|integer|min:0',
            'fechaInauguracion' => 'required|date',
            'activo' => 'boolean',
        ];
    }
}

