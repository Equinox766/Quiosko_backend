<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password as PasswordValidator;

class RegistroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required','string','min:3','max:255'],
            'email' => ['required','email','unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                PasswordValidator::min(8)->letters()->symbols()->numbers(),
            ],
        ];
    }
    public function messages()
    {
        return [
            'password' => 'La Contraseña debe contener al menos 8 caracteres, un simbolo y un número',
            'email.email' => 'El email no es válido',
            'email.unique' => 'El usuario ya esta registrado',
        ];
    }
}
