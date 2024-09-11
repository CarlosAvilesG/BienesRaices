<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePagoLoteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'idPredio' => 'required|exists:predio,idPredio',
            'idLote' => 'required|exists:lotes,idLote',
            'folio' => 'nullable|integer',
            'idContrato' => 'nullable|integer',
            'idCliente' => 'required|exists:clientes,idCliente',
            'tipoPago' => 'required|string|max:50',
            'referenciaBancaria' => 'nullable|string|max:100',
            'monto' => 'required|numeric|min:0',
            'pagoNumero' => 'nullable|integer',
            'deudaAnterior' => 'nullable|numeric|min:0',
            'fechaPago' => 'required|date',
            'horaPago' => 'required|string|max:8',
            'idUsuario' => 'required|exists:users,id',
            'observacion' => 'nullable|string',
            'cancelar' => 'boolean',
            'idUsuarioCancela' => 'nullable|exists:users,id',
            'pagoValidado' => 'boolean',
            'idUsuarioValidaPago' => 'nullable|exists:users,id',
            'historico' => 'boolean',
        ];
    }
}
