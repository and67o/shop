<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $rules = [
            'name' => 'required|min:3|max|255',
            'description' => 'required|min:3|max|255',
            'price' => 'required|numeric|min:1'
        ];
        if ($this->route()->named('categories.store')) {
            $rules['name'] .= '|unique:products,name';
        }
        return $rules;
    }
}
