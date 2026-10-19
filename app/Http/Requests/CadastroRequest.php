<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastroRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'txNome' => ['required', 'string', 'min:3'],
            'txEmail' =>['required', 'email', 'unique:usuario,email'],
            'txSenha' =>['required', 'string', 'min:6'],
            'password_confirm' => ['required','same:txSenha'],
        ];
    }
    public function messages(){
        return [
            'txNome.required' => 'O campo de nome deve ser preenchido!',
            'txNome.min'=> 'O campo de nome deve ter no mínimo 3 letras!',
            'txEmail.required' => 'O campo de email deve ser preenchido!',
            'txEmail.unique' => 'Esse email já foi cadastrado!',
            'txSenha.required' => 'O campo de senha deve ser preenchido!',
            'txSenha.min' => 'A sua senha deve ter no mínimo 6 caracteres!',
            'password_confirm.required' => 'Confirme sua senha!',
            'password_confirm.same' => 'As senhas não coincidem!',
        ];
    }
}
