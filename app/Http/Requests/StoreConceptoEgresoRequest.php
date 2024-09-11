<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConceptoEgresoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;  // Cambiar a false si es necesario agregar reglas de autorización.
    }

    public function rules(): array
    {
        return [
            'descripcion' => 'required|string|max:50',
            'gastoCorriente' => 'boolean',
            'requiereDevolucion' => 'boolean',
        ];
    }
}

