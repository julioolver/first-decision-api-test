<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->id)],
            'password' => ['string', 'min:6', 'max:20', 'confirmed'],
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
            'password_confirmation.required' => 'O campo Confirmação de Senha (password_confirmation) é obrigatório',
            'name.required' => 'O campo Nome (name) é obrigatório',
            'email.required' => 'O campo E-mail (email) é obrigatório',
        ];
    }
}
