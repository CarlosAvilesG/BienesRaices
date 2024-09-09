<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta solicitud.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Aquí puedes implementar lógica de autorización, por ejemplo,
        // solo permitir que ciertos usuarios puedan crear un cliente.
        // Por ahora, permitimos que todos puedan hacer esta solicitud.
        return true;
    }

    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     *
     * @return array<string, string|array>
     */
    public function rules(): array
    {
        return [
            'paterno' => 'required|string|max:30',
            'materno' => 'required|string|max:30',
            'nombre' => 'required|string|max:30',
            'curp' => 'required|string|max:30|unique:clientes,curp',
            'rfc' => 'required|string|max:30|unique:clientes,rfc',
            'ine' => 'required|string|max:90|unique:clientes,ine',
            'direccion' => 'nullable|string|max:300',
            'direccionEntreCalle' => 'nullable|string|max:50',
            'codigoPostal' => 'nullable|integer',
            'colonia' => 'nullable|string|max:50',
            'numeroExterior' => 'nullable|string|max:10',
            'telefonoCasa' => 'nullable|string|max:30',
            'celular' => 'required|string|max:30',
            'trabajo' => 'nullable|string|max:100',
            'trabajoDireccion' => 'nullable|string|max:300',
            'trabajoTelefono' => 'nullable|string|max:30',
            'estadoRepublica' => 'nullable|string|max:30',
            'municipio' => 'nullable|string|max:45',
            'localidad' => 'nullable|string|max:45',
            'correoElectronico' => 'required|string|max:45|unique:clientes,correoElectronico',
            'pass' => 'required|string|max:60',
            'usuarioWeb' => 'nullable|string|max:45',
            'foto_url' => 'nullable|string',
            'fechaRegistro' => 'required|date',
            'morosidad_activa' => 'boolean',
            'monto_deuda_actual' => 'numeric|min:0',
            'ultima_actualizacion_morosidad' => 'nullable|date',
            'idUsuario' => 'required|exists:users,id'
        ];
    }

    /**
     * Obtiene los mensajes de error personalizados para las reglas de validación.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'paterno.required' => 'El apellido paterno es obligatorio.',
            'materno.required' => 'El apellido materno es obligatorio.',
            'nombre.required' => 'El nombre es obligatorio.',
            'curp.required' => 'El CURP es obligatorio.',
            'curp.unique' => 'El CURP ya ha sido registrado.',
            'rfc.required' => 'El RFC es obligatorio.',
            'rfc.unique' => 'El RFC ya ha sido registrado.',
            'ine.required' => 'El INE es obligatorio.',
            'ine.unique' => 'El INE ya ha sido registrado.',
            'correoElectronico.required' => 'El correo electrónico es obligatorio.',
            'correoElectronico.unique' => 'El correo electrónico ya ha sido registrado.',
            'pass.required' => 'La contraseña es obligatoria.',
            'idUsuario.required' => 'El usuario es obligatorio.',
            'idUsuario.exists' => 'El usuario seleccionado no es válido.'
        ];
    }
}
