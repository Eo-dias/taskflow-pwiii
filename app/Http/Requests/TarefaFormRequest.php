<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TarefaFormRequest extends FormRequest
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
            'txProjeto' => ['required', 'integer', 'exists:projeto,id'],
            'txData' => ['required', 'date'],
        ];
    }

    public function messages()
    {
        return [
            'txNome.required' => 'O título da tarefa é obrigatório.',
            'txNome.min' => 'O título deve ter no mínimo :min caracteres.',
            'txNome.max' => 'O título deve ter no máximo :max caracteres.',
            'txDesc.required' => 'A descrição da tarefa é obrigatória.',
            'txDesc.min' => 'A descrição deve ter no mínimo :min caracteres.',
            'txDesc.max' => 'A descrição deve ter no máximo :max caracteres.',
            'txProjeto.required' => 'Selecione um projeto.',
            'txProjeto.exists' => 'O projeto selecionado não é válido.',
            'txData.required' => 'O prazo da tarefa é obrigatório.',
            'txData.date' => 'Informe uma data válida para o prazo.',
        ];
    }
}
