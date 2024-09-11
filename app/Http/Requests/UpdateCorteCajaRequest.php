<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCorteCajaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cambia esto si necesitas autorización específica
    }

    public function rules(): array
    {
        return [
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date',
            'totalIngresosFisicos' => 'required|numeric|min:0',
            'totalIngresosBancarios' => 'required|numeric|min:0',
            'totalEgresos' => 'required|numeric|min:0',
            'totalPrestamos' => 'required|numeric|min:0',
            'idUsuario' => 'required|exists:users,id',
        ];
    }
}
