<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SessaoPost extends FormRequest
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
         return  [
             
             'filme_id' =>  'required',
             'sala_id' =>       'required',
             'data' =>       'required',
             'horario_inicio' =>       'required'     
         ];
    }

    public function messages()
    {
    
        return [
            'filme_id.required' => 'Insira um filme',
            'sala_id.required' => 'Insira uma sala',
            'data' => 'Insira uma data',
            'horario_inicio' => 'Insira a hora de inicio'
        
        ];
    }
}
