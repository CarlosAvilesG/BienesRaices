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
        $this->merge([
            'monto' => str_replace(['$', ','], '', $this->monto), // Convierte a número decimal

        ]);

        return [
          //  'contrato_id' => 'required|exists:contratos,id',
            'idPredio' => 'required|exists:predios,id',
            'idLote' => 'required|exists:lotes,id',
            'folio' => 'nullable|integer',
            'idContrato' => 'required|integer',
            'idCliente' => 'required|exists:clientes,id',
            'motivo' => 'required|string| in:Enganche,Mensualidad,Anualidad',
            'tipoPago' => 'required|string| in:Efectivo,Cheque,Transferencia',
            'referenciaBancaria' => 'nullable|string|max:100',
            'monto' => 'required|numeric|min:0',
            'pagoNumero' => 'nullable|integer',
            'deudaAnterior' => 'nullable|numeric|min:0',
            'fechaPago' => 'required|date',
            'horaPago' => 'required|string|max:8',
            'idUsuario' => 'required|exists:users,id',
            'observacion' => 'nullable|string',
           // 'cancelar' => 'boolean',
           // 'idUsuarioCancela' => 'nullable|exists:users,id',
           // 'pagoValidado' => 'boolean',
           // 'idUsuarioValidaPago' => 'nullable|exists:users,id',
           // 'historico' => 'boolean',
        ];
    }
}
