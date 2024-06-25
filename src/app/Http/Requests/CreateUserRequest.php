<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'max:20', 'confirmed'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'password.required' => 'O campo Senha (password) é obrigatório',
            'password_confirmation.required' => 'O campo Confirmação de Senha (password_confirmation) é obrigatório',
            'name.required' => 'O campo Nome (name) é obrigatório',
            'email.required' => 'O campo E-mail (email) é obrigatório',
            'email.unique' => 'Este e-mail já está em uso',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres',
            'password.max' => 'A senha deve ter no maúximo 20 caracteres',
            'password.confirmed' => 'As senhas devem ser iguais',
            'current_password.required' => 'O campo Senha Atual é obrigatório',
            'name.min' => 'O nome deve ter pelo menos 3 caracteres',
            'name.max' => 'O nome deve ter no maúximo 50 caracteres',
        ];
    }
}
