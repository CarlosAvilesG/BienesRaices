<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCorteCajaDetalleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'idCorteCaja' => 'required|exists:corte_caja,idCorteCaja',
            'idPagoLote' => 'nullable|exists:pagos_lote,id',
            'idEgreso' => 'nullable|exists:egresos,idEgresos',
            'monto' => 'required|numeric|min:0',
            'tipoMovimiento' => 'required|string|max:20',
        ];
    }
}

