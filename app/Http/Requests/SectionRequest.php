<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
            'section_name' => 'required|unique:sections,section_name|max:255',
            'description' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'section_name.required' => 'اسم القسم  مطلوب',
            'description.required' => '  الوصف مطلوب',
            'section_name.unique' => ' اسم القسم موجود بالفعل حاول مره اخرى',
            'section_name.max' => 'اسم القسم  لايجب ان يذيد عن 255 حرف',
        ];
    }
}
