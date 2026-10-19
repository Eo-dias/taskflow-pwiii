<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Exists;
use Override;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
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
            'email' => ['required','email', 'exists:usuario,email'],
            'password' => ['required', 'string', 'min:6']
        ];
    }
    #[Override]
    public function messages()
    {
        return [
            'email.required' => 'O campo de email deve ser preenchido!',
            'email.exists' => 'Esse email não está cadastrado no nosso sistema!',
            'password.required' => 'O campo de senha deve ser preenchido!',
            'password.min' => 'A sua senha deve ter no mínimo 6 caracteres!',
        ];
    }
}
