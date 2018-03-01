<?php

namespace sisInventario\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoFormRequest extends FormRequest
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
            'idcategoria'=>'required',
            'nombre'=>'required|max:100',
            'stock'=>'required|numeric',
            'unidad_medida'=>'required|max:100',
            'descripcion'=>'max:512'
        ];
    }
}
