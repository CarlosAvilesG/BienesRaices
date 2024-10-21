<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreContratoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $this->merge([
            'precioPredio' => str_replace(['$', ','], '', $this->precioPredio), // Convierte a número decimal
            'enganche' => str_replace(['$', ','], '', $this->enganche), // Convierte a número decimal
        ]);

        return [
            'identificadorContrato' => 'required|string|max:50|unique:contratos',
            'idCliente' => 'required|exists:clientes,id',
            'idLote' => 'required|exists:lotes,id',
            'noContrato' => 'required|string|max:50',
            'noConvenio' => 'nullable|string|max:10',
            'noAnios' => 'nullable|integer|min:0',
            'noLetras' => 'nullable|integer|min:1',
            'precioPredio' => 'nullable|numeric|min:0', // 'nullable', // SE CALCULA EN EL CONTROLADOR
            'interesMoroso' => 'nullable|numeric|min:0|max:99.9',
            'fechaCelebracion' => 'required|date',
            'horaCelebracion' => 'required|string|max:8',
            'fechaTerminoLetras' => 'nullable|date',
            // crearregla para  $table->enum('ConvenioTemporalidadPago', ['Quincenal', 'Menusual'])->default('Menusual');
            'convenioTemporalidadPago' => 'nullable|in:Quincenal,Mensual',
            'convenioViaPago' => 'nullable|in:Efectivo,Bancario,Nomina',
            'anualidades' => 'nullable|integer|min:0|max:10',
            'pagoAnualidad' => [
                                    'nullable',
                                    'numeric',
                                    'min:0',
                                    'max:100000',
                                    Rule::when($this->input('anualidades') > 0, ['gt:0']),
                                ],


            'enganche' => 'nullable|numeric|min:0',

           // 'FechaRegistro' => 'required|date',
           // 'HoraRegistro' => 'required|string|max:8',
            'idUsuario' =>  'nullable', //|exists:users,id', //'required| exists:users,id',
            'observacion' => 'nullable|string',
            'cancelado' => 'boolean',
           // 'idUsuCancela' => 'nullable|exists:users,id',
            'canceladoObservacion' => 'nullable|string',
        ];
    }
}
