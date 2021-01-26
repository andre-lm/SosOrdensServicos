<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcompanhamentoRequest extends FormRequest
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
            //'requerente'    => 'required|min:3',
            'descrição'     => 'required|min:10'
        ];
    }
    public function attributes()
    {
        return [
            'requerente'    => 'Requerente',
            'descrição'     => 'Descrição'
        ];
    }
}
