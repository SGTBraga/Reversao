<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ValidarInclusao extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {


        $validacao = array();
        $validacao['CPF'] = 'required';
        $validacao['NOME'] = 'required';
        $validacao['VLREVERSAO'] = 'required';
        $validacao['MESANOINICIO'] = 'required';
        $validacao['MESANOFIM'] = 'required';
        $validacao['BANCO'] = 'required';
        $validacao['AGENCIA'] = 'required';
        $validacao['CONTA'] = 'required';
        $validacao['REQUERIMENTO'] = 'mimes:pdf|max:2000';
        $validacao['CONTRACHEQUE'] = 'mimes:pdf|max:2000';
        $validacao['OBITO'] = 'mimes:pdf|max:2000';
        $validacao['TX_MENSAGEM_TEXTO'] = 'required';
        return $validacao;
    }

    public function messages() {
        return [
            'CPF.required' => 'O campo CPF é obrigatório!',
            'NOME.required' => 'O campo NOME DO SERVIDOR é obrigatório!',
            'VLREVERSAO.required' => 'O campo VALOR REVERSÃO é obrigatório!',
            'MESANOINICIO.required' => 'O campo MÊS DE INICIO é obrigatório!',
            'MESANOFIM.required' => 'O campo MÊS FINAL deve seguir o formato padrão da Web!',
            'BANCO.required' => 'O campo BANCO é obrigatório!',
            'AGENCIA.required' => 'O campo AGENCIA é obrigatório!',
            'CONTA.required' => 'O campo CONTA é obrigatório!',
            'REQUERIMENTO' => 'O arquivo é obrigatório, e deve ser do tipo PDF',
            'CONTRACHEQUE' => 'O arquivo é obrigatório, e deve ser do tipo PDF',
            'OBITO' => 'O arquivo é obrigatório, e deve ser do tipo PDF',
        ];
    }

}
