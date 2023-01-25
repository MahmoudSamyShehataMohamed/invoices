<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Invoiceattachment;
use Illuminate\Support\Facades\File;

class InvoicearchiveController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ارشيف الفواتير', ['only' => ['index']]);
    }

    public function index()
    {
        $invoices = Invoice::onlyTrashed()->get();
        return view('invoices.invoicesarchive',compact('invoices'));
    }



    public function archiveInvoice($id)
    {
        $invoice = Invoice::find($id);
        if(!$invoice)
        return redirect()->route('invoices.index')->with(['notfound' => 'غير موجود']);

        $attachments = Invoiceattachment::where('invoice_id',$id)->first();
        if(!empty($attachments->invoice_number))
        {
            $path = public_path('uploads/' . $attachments->invoice_number);
            File::deleteDirectory($path);
        }
        $invoice->delete();
        return redirect()->route('invoices.index')->with(['archive' => 'تم ارشفة الفاتوره بنجاح']);

    }


    public function transferToInvoices($id)
    {
        $invoice = Invoice::onlyTrashed()->find($id);
        if(!$invoice)
        return redirect()->route('invoicesarchive.index')->with(['notfound' => 'غير موجود']);

        $restore = Invoice::withTrashed()->where('id', $id)->restore();
        return redirect()->route('invoicesarchive.index')->with(['transferetoinvoices' => 'تم استعادة الفاتوره بنجاح']);

    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }



    public function show($id)
    {

    }


    public function edit($id)
    {

    }


    public function update($id)
    {

    }

    public function formDeleteArchiveInvoices($id)
    {
        $invoice = Invoice::onlyTrashed()->find($id);//لازم تعملها كدا عشان هو مش بيشوف اى اى دى معموله تراشد او يعنى الديليتيد ات بتاعه محطوط فيه تاريخ فانا بحطله دى بقوله يعنى رووح دور فى ال هى ديهات اللى معمولها تراشد
        if(!$invoice)
        return redirect()->route('invoicesarchive.index')->with(['notfound' => 'غير موجود']);

        return view('invoices.formdeletearchiveinvoices',compact('invoice'));
    }

    public function destroy($id)
    {
        $invoice = Invoice::onlyTrashed()->find($id);
        if(!$invoice)
        return redirect()->route('invoicesarchive.index')->with(['notfound' => 'غير موجود']);

        $attachments =Invoiceattachment::where('invoice_id',$id)->first();

        if(!empty($attachments->invoice_number))
        {
            $path = 'uploads/' . $attachments->invoice_number;
            File::deleteDirectory($path);
        }

        $invoice->forceDelete();
        return redirect()->route('invoicesarchive.index')->with(['delete' => 'تم الحذف بنجاح']);

    }
}
