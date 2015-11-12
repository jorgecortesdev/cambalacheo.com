<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ContactRequest extends Request
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
        if ($this->isMethod('post')) {
            return [
                'name'                 => 'required|min:5|max:255',
                'email'                => 'required|email|max:255',
                'message'              => 'required|min:5|max:255',
                'g-recaptcha-response' => 'required|recaptcha',
            ];
        }

        return [];
    }

    public function messages()
    {
        return [
            'required' => 'Este campo es requerido.',
            'max'      => 'No debe ser mayor a :max caracteres.',
            'min'      => 'No debe ser menor a :min caracteres.',
            'recaptcha'=> 'Indicanos que eres humano.'
        ];
    }
}
