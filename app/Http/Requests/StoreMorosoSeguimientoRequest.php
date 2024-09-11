<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMorosoSeguimientoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'idMoroso' => 'required|exists:morosos,id',
            'fecha_contacto' => 'required|date',
            'medio_contacto' => 'required|string|max:50',
            'detalle_contacto' => 'nullable|string',
            'acuerdo' => 'nullable|string',
            'idUsuario' => 'required|exists:users,id',
        ];
    }
}
