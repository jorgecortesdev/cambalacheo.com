<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SearchRequest extends Request
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
            'query' => 'required|min:3|max:25'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Este campo es requerido.',
            'max'      => 'No debe ser mayor a :max caracteres.',
            'min'      => 'No debe ser menor a :min caracteres.',
        ];
    }
}
