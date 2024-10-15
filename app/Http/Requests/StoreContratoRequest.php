<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContratoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $this->merge([
            'PrecioPredio' => str_replace(['$', ','], '', $this->PrecioPredio), // Convierte a número decimal
        ]);

        return [
            'identificadorContrato' => 'required|string|max:50|unique:contratos',
            'idCliente' => 'required|exists:clientes,id',
            'idLote' => 'required|exists:lotes,id',
            'NoContrato' => 'required|string|max:50',
            'NoConvenio' => 'nullable|string|max:10',
            'NoAnios' => 'nullable|integer|min:0',
            'NoLetras' => 'nullable|integer|min:0',
            'PrecioPredio' => 'required|numeric|min:0',
            'InteresMoroso' => 'nullable|numeric|min:0|max:99.9',
            'FechaCelebracion' => 'required|date',
            'HoraCelebracion' => 'required|string|max:8',
            'FechaTerminoLetras' => 'nullable|date',
            'ConvenioTemporalidadPago' => 'nullable|string|max:50',
            'ConvenioViaPago' => 'nullable|string|max:50',
            'Anualidades' => 'nullable|integer|min:0',
            'PagoAnualidad' => 'nullable|numeric|min:0',
            'Enganche' => 'nullable|numeric|min:0',

           // 'FechaRegistro' => 'required|date',
           // 'HoraRegistro' => 'required|string|max:8',
            'idUsuario' =>  'nullable|exists:users,id', //'required|exists:users,id',
            'observacion' => 'nullable|string',
            'cancelado' => 'boolean',
           // 'idUsuCancela' => 'nullable|exists:users,id',
            'CanceladoObservacion' => 'nullable|string',
        ];
    }
}
