<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjetoFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'txNome' => ['required', 'string', 'min:3', 'max:255'],
            'txDesc' => ['required', 'string', 'min:3', 'max:1000'],
            'txUser' => ['required', 'integer', 'exists:usuario,id'],
        ];
    }

    public function messages()
    {
        return [
            'txNome.required' => 'O nome do projeto é obrigatório.',
            'txNome.min' => 'O nome do projeto deve ter no mínimo :min caracteres.',
            'txNome.max' => 'O nome do projeto deve ter no máximo :max caracteres.',
            'txDesc.required' => 'A descrição do projeto é obrigatória.',
            'txDesc.min' => 'A descrição deve ter no mínimo :min caracteres.',
            'txDesc.max' => 'A descrição deve ter no máximo :max caracteres.',
            'txUser.required' => 'Selecione um usuário responsável.',
            'txUser.exists' => 'O usuário selecionado não é válido.',
        ];
    }
}
