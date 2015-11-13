<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class OfferRequest extends Request
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
            'description' => 'required|min:10|max:255',
        ];
    }

    public function messages()
    {
        return [
            'required'        => 'Este campo es requerido.',
            'description.max' => 'No debe ser mayor a :max caracteres.',
            'description.min' => 'No debe ser menor a :min caracteres.',
        ];
    }
}
