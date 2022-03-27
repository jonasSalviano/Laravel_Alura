<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnimesFormRequest extends FormRequest
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
            'nome' => 'required|min: 3'
        ];
    }

    public function messages()
    {
        return [
            'required' => ' O campo :attribute tem que ser preenchido',
            'nome.min' => 'o campo nome tem que ter pelo menos 3 caracteres'
        ];
    }
}
