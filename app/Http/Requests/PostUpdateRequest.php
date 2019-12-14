<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
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
            'name'=>'required',
            /*al  colocarle .$this->tag, al final de la linea se evita que se genere un error 
            cuando se este editando la etiquet ya que se verificara que no se repitan las etiquetas 
            pero se omitira la que se encuentre en edicion en ese preciso instante*/
            'slug'=>'required|unique:posts,slug,'.$this->post,
        ];
    }
}
