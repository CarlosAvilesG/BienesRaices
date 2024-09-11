<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMorosoSeguimientoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'idMoroso' => 'sometimes|required|exists:morosos,id',
            'fecha_contacto' => 'sometimes|required|date',
            'medio_contacto' => 'sometimes|required|string|max:50',
            'detalle_contacto' => 'nullable|string',
            'acuerdo' => 'nullable|string',
            'idUsuario' => 'sometimes|required|exists:users,id',
        ];
    }
}
