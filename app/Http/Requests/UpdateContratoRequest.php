<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContratoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'identificadorContrato' => 'required|string|max:50|unique:contratos',
            'idCliente' => 'required|exists:clientes,idCliente',
            'idLote' => 'required|exists:lotes,idLote',
            'noContrato' => 'required|string|max:50',
            'noConvenio' => 'nullable|string|max:10',
            'noLetras' => 'nullable|integer|min:0',
            'precioPredio' => 'required|numeric|min:0',
            'interesMoroso' => 'nullable|numeric|min:0|max:99.9',
            'fechaCelebracion' => 'required|date',
            'horaCelebracion' => 'required|string|max:8',
            'fechaTerminoLetras' => 'nullable|date',
            'convenioTemporalidadPago' => 'nullable|string|max:50',
            'convenioViaPago' => 'nullable|string|max:50',
            'fechaRegistro' => 'required|date',
            'horaRegistro' => 'required|string|max:8',
            'idUsuario' => 'required|exists:users,id',
            'observacion' => 'nullable|string',
           
            'idUsuCancela' => 'nullable|exists:users,id',
            'canceladoObservacion' => 'nullable|string',
        ];
    }
}
