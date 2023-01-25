<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'invoice_number' => 'required|unique:invoices,invoice_number|max:255,',
            'invoice_Date' => 'required|date',
            'Due_date' => 'required|date',
            'Section' => 'required|numeric',
            'product' => 'required|max:255',
            'Amount_collection' => 'nullable',
            'Amount_Commission' => 'required|numeric',//لايقبل قيمة سالبه
            'Discount' => 'required|nullable',//default value 0
            'Rate_VAT' => 'required',//default value 0
            'Value_VAT' => 'required',//default value 0
            'Total' => 'required',
            'note'   => 'nullable',
            'pic' => 'mimes:jpg,png,pdf,jpeg|max:10000',

        ];
    }

    // public function messages()
    // {
    //     return [

    //     ];
    // }
}
