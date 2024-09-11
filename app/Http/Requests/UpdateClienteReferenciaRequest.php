<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteReferenciaRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta solicitud.
     */
    public function authorize(): bool
    {
        // Cambiar a true si no tienes un sistema de autorización basado en roles.
        return true;
    }

    /**
     * Obtiene las reglas de validación que se aplicarán a la solicitud.
     */
    public function rules(): array
    {
        return [
            'paterno' => 'sometimes|required|string|max:30',
            'materno' => 'sometimes|required|string|max:30',
            'nombre' => 'sometimes|required|string|max:30',
            'telefono' => 'sometimes|required|string|max:30',
            'trabajo' => 'sometimes|required|string|max:50',
            'trabajoDireccion' => 'sometimes|required|string|max:100',
            'trabajoTelefono' => 'sometimes|required|string|max:30',
        ];
    }
}
