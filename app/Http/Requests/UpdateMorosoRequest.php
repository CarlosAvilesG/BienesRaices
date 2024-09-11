<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMorosoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'idCliente' => 'sometimes|required|exists:clientes,idCliente',
            'montoDeuda' => 'sometimes|required|numeric|min:0',
            'activo' => 'boolean',
            'fecha_inicio' => 'sometimes|required|date',
            'fecha_resolucion' => 'nullable|date|after_or_equal:fecha_inicio',
        ];
    }
}
