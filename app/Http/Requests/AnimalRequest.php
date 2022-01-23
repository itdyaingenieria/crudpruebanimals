<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnimalRequest extends FormRequest
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
            'tipo' => 'required',
            'peligrosidad' => 'required',
            'edad' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'tipo.required' => 'El Tipo es Necesario.' ,
            'peligrosidad.required' => 'El dato Peligrosidad es Necesario.' ,

        ];
    }
}
