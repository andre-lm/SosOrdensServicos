<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OsRequest extends FormRequest
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
            // 'nome_autor'        => 'required|min:3',
            'atribuido_tecnico' => 'required',
            'equipamento'       => 'required|min:5',
            'titulo'            => 'required|min:3',
            'descrição'         => 'required|min: 10'
        ];
    }

    public function attributes()
    {
        return [
            'nome_autor'        => 'Nome do Autor',
            'atribuido_tecnico' => 'Técnico',
            'equipamento'       => 'Equipamento',
            'titulo'            => 'Título',
            'descrição'         => 'Descrição'
        ];
    }
}
