<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMorosoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'idCliente' => 'required|exists:clientes,idCliente',
            'montoDeuda' => 'required|numeric|min:0',
            'activo' => 'boolean',
            'fecha_inicio' => 'required|date',
            'fecha_resolucion' => 'nullable|date|after_or_equal:fecha_inicio',
        ];
    }
}
