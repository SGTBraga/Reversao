<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GravarUsuario extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'CPF' => 'required',
            'NOME' => 'required',
            'NOME_GUERRA' => 'required',
            'EMAIL' => 'required|email',
            'PERFIL' => 'required',
            'UNIDADE' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'CPF.required' => 'O campo CPF é obrigatório!',
            'NOME.required' => 'O campo NOME é obrigatório!',
            'NOME_GUERRA.required' => 'O campo NOME DE GUERRA é obrigatório!',
            'EMAIL.required' => 'O campo EMAIL é obrigatório!',
            'EMAIL.email' => 'O campo EMAIL deve seguir o formato padrão da Web!',
            'PERFIL.required' => 'O campo PERFIL é obrigatório!',
            'UNIDADE.required' => 'O campo UNIDADE é obrigatório!',
        ];
    }
}
