<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'idPredio' => 'required|exists:predio,idPredio',
            'manzana' => 'required|integer|min:0',
            'lote' => 'required|integer|min:0',
            'descripcion' => 'nullable|string|max:50',
            'regular' => 'required|boolean',
            'donacion' => 'required|boolean',
            'loteComercial' => 'required|boolean',
            'loteReparable' => 'nullable|string|max:5',
            'loteReparableObs' => 'nullable|string|max:300',
            'inhabilitado' => 'required|boolean',
            'metrosFrente' => 'required|numeric|min:0',
            'metrosAtras' => 'required|numeric|min:0',
            'metrosDerecho' => 'required|numeric|min:0',
            'metrosIzquierda' => 'required|numeric|min:0',
            'metrosCuadrados' => 'required|numeric|min:0',
            'precio' => 'required|numeric|min:0',
            'plazoMeses' => 'nullable|integer|min:0',
            'pagoMensual' => 'nullable|numeric|min:0',
            'estatusPago' => 'required|in:pendiente,pagado,atrasado',
        ];
    }
}
