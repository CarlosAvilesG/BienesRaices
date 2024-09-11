<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFraseEticaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'frase' => 'required|string',
            'autor' => 'nullable|string|max:100',
        ];
    }
}
