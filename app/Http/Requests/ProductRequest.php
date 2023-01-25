<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
            'product_name' => 'required|unique:products,product_name|max:255,',
            'section_id' => 'required',
            'description' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'product_name.required' => 'اسم المنتج  مطلوب',
            'product_name.unique' => ' اسم المنتج موجود بالفعل حاول مره اخرى',
            'product_name.max' => 'اسم المنتج  لايجب ان يذيد عن 255 حرف',
            'section_id.required' => 'اسم القسم  مطلوب',
            'description.required' => '  الوصف مطلوب',
        ];
    }
}
