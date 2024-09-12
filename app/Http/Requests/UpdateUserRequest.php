<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'paterno' => 'sometimes|required|string|max:255',
            'materno' => 'sometimes|required|string|max:255',
            'nombre' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $this->route('user'),
            'password' => 'nullable|string|min:8|confirmed',rules\Password::defaults(),
        ];
    }
}
