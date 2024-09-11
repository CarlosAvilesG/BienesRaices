<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteReferenciaRequest extends FormRequest
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
            'idCliente' => 'required|exists:clientes,idCliente',
            'paterno' => 'required|string|max:30',
            'materno' => 'required|string|max:30',
            'nombre' => 'required|string|max:30',
            'telefono' => 'required|string|max:30',
            'trabajo' => 'required|string|max:50',
            'trabajoDireccion' => 'required|string|max:100',
            'trabajoTelefono' => 'required|string|max:30',
        ];
    }
}
