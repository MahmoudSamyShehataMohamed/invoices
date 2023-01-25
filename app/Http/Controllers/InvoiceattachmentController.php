<?php

namespace App\Http\Controllers;

use App\Models\Invoiceattachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class InvoiceattachmentController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'file_name' => 'mimes:pdf,jpeg,png,jpg',
        ],[
            'file_name.mimes' => 'صيغة المرفق يجب ان تكون   pdf, jpeg , png , jpg',
        ]);


        $invoice_number = $request->invoice_number;
        $invoice_id = $request->invoice_id;
        $filename = time() . '.' . $request->pic->extension(); // you can use getClientOriginalName() function
        $path = 'uploads';
        $request->pic->move(public_path($path . '/' . $invoice_number), $filename);
        Invoiceattachment::create([
            'file_name' => $filename,
            'invoice_number' => $request->invoice_number,
            'Created_by' => (Auth::user()->name),
            'invoice_id' => $invoice_id,
        ]);
        // return $request->file('pic')->store('uploads');

        return redirect()->back()->with(['success' => 'تم الاضافه بنجاح']);


    }


    public function show(Invoiceattachment $invoiceattachment)
    {
        //
    }


    public function edit(Invoiceattachment $invoiceattachment)
    {
        //
    }


    public function update(Request $request, Invoiceattachment $invoiceattachment)
    {
        //
    }


    public function destroy(Invoiceattachment $invoiceattachment)
    {
        //
    }
}
