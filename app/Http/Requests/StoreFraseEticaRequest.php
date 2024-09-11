<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFraseEticaRequest extends FormRequest
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
