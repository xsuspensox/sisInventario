<?php

namespace sisInventario\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalFormRequest extends FormRequest
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
            'nombre'=>'required|max:100',
            'tipo_documento'=>'required|max:20',
            'num_documento'=>'required|numeric',
            'direccion'=>'max:70',
            'telefono'=>'max:50',
            'email'=>'max:50'
        ];
    }
}
