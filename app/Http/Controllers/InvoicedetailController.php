<?php

namespace App\Http\Controllers;

use App\Models\Invoicedetail;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Invoiceattachment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
class InvoicedetailController extends Controller
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
        //
    }


    public function show($id)
    {
        $invoicedetails = Invoicedetail::where('id_Invoice', $id)->get();
        if(!$invoicedetails)
        return redirect()->back()->with(['error' => 'غير موجود']);

        $invoice = Invoice::where('id', $id)->first();
        if(!$invoice)
        return redirect()->back()->with(['error' => 'غير موجود']);

        $invoiceattachments = Invoiceattachment::where('invoice_id', $id)->get();
        if(!$invoiceattachments)
        return redirect()->back()->with(['error' => 'غير موجود']);
        return view('invoices.invoicedetails', compact('invoice', 'invoicedetails', 'invoiceattachments'));
    }

    public function openFile($invoice_number, $file_name)
    {
        $folder = "uploads";
        $pathToFile = public_path($folder . '/' . $invoice_number . '/' . $file_name);
        return response()->file($pathToFile);
    }
    public function downloadFile($invoice_number, $file_name)
    {
        $st = "uploads";
        $pathToFile = public_path($st . '/' . $invoice_number . '/' . $file_name);
        return response()->download($pathToFile);
    }

    public function formDelete($id)
    {
        $attachment = Invoiceattachment::find($id);
        if(!$attachment)
        return redirect()->back()->with(['error' => 'غير موجود']);

        return view('invoices.formdelete',compact('attachment'));
        // $attachment = Invoiceattachment::find($id);
        // if(!$attachment)
        // return redirect()->back()->with(['error' => 'غير موجود']);
        // $attachment->delete();
        // $st = "uploads";
        // $pathToFile = public_path($st . '/' . $invoice_number . '/' . $file_name);
        // return response()->download($pathToFile);
        // return redirect()->back()->with(['success' => 'تم الحذف بنجاح']);
    }


    public function edit($id)
    {

    }

    public function update(Request $request ,$id)
    {
    }


    public function destroy(Request $request,$id)
    {
        $attachment = Invoiceattachment::find($id);
        if(!$attachment)
        return redirect()->route('invoices.index')->with(['error' => 'غير موجود']);
        $attachment->Delete();

        $pathToFile =public_path('uploads/'. $request->invoice_number . '/' . $request->file_name);
        File::delete($pathToFile);
        // $pathToFile =public_path('uploads/'. $request->invoice_number . '/' . $request->file_name);//مشتغلش
        // Storage::delete($pathToFile);//مشتغلش

        return redirect()->route('invoices.index')->with(['deletefile' => 'تم الحذف بنجاح']);
    }
}
