<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBitacoraRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cambiar a false si es necesario aplicar lógica de autorización.
    }

    public function rules(): array
    {
        return [
            'fecha' => 'required|date',
            'usuario' => 'required|exists:users,id',
            'tabla' => 'required|string|max:50',
            'tipoOperacion' => 'required|string|max:20',
            'campoLlave' => 'required|string|max:50',
            'descripcion' => 'nullable|string',
            'ip' => 'nullable|string|max:45',
            'user_agent' => 'nullable|string',
        ];
    }
}
