<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEgresoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'idConcepto' => 'required|exists:concepto_egreso,idConcepto',
            'descripcion' => 'nullable|string|max:300',
            'monto' => 'required|numeric|min:0',
            'idUsuarioRecibe' => 'required|exists:users,id',
            'fecha' => 'required|date',
            'hora' => 'required|string|max:8',
            'idUsuario' => 'required|exists:users,id',
            'supervisado' => 'boolean',
            'idUsuSupervisa' => 'nullable|exists:users,id',
            'cancelado' => 'boolean',
            'idUsuCancela' => 'nullable|exists:users,id',
            'pendienteDevolucion' => 'boolean',
            'montoDevuelto' => 'nullable|numeric|min:0',
            'fechaDevolucion' => 'nullable|date',
            'idUsuarioDevuelve' => 'nullable|exists:users,id',
        ];
    }
}
