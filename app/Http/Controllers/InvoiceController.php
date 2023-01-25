<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Invoiceattachment;
use App\Models\Invoicedetail;
use Illuminate\Http\Request;
use App\Models\Section;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\InvoiceRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Notifications\Addinvoice;
use Illuminate\Support\Facades\Notification;

class InvoiceController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:قائمة الفواتير', ['only' => ['index']]);
        $this->middleware('permission:الفواتير المدفوعة', ['only' => ['invoicesPaid']]);//function name example index
        $this->middleware('permission:الفواتير الغير مدفوعة', ['only' => ['invoicesUnpaid']]);
        $this->middleware('permission:الفواتير المدفوعة جزئيا', ['only' => ['invoicesPartial']]);
        $this->middleware('permission:اضافة فاتورة', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل الفاتورة', ['only' => ['edit', 'update']]);
        $this->middleware('permission:حذف الفاتورة', ['only' => ['destroy']]);
    }

    public function index()
    {
        $invoices = Invoice::all();
        return view('invoices.invoices', compact('invoices'));
    }

    public function invoicesPaid()
    {
        $invoices = Invoice::where('Value_status',1)->get();
        return view('invoices.invoicespaid', compact('invoices'));
    }

    public function invoicesUnpaid()
    {
        $invoices = Invoice::where('Value_status',2)->get();
        return view('invoices.invoicesunpaid', compact('invoices'));
    }

    public function invoicesPartial()
    {
        $invoices = Invoice::where('Value_status',3)->get();
        return view('invoices.invoicespartial', compact('invoices'));
    }


    public function getproducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("Product_name", "id");
        return json_encode($products);
    }


    public function create()
    {
        $sections = Section::all();
        return view('invoices.add_invoice', compact('sections'));
    }




    public function store(InvoiceRequest $request)
    {

        Invoice::create([
            'invoice_number'    => $request->invoice_number,
            'invoice_Date'      => $request->invoice_Date,
            'Due_date'          => $request->Due_date,
            'product'           => $request->product,
            'section_id'        => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount'          => $request->Discount,
            'Value_VAT'         => $request->Value_VAT,
            'Rate_VAT'          => $request->Rate_VAT,
            'Total'             => $request->Total,
            'Status'            => 'غير مدفوعة',
            'Value_Status'      => 2,
            'note'              => $request->note,
        ]);

        $invoice_id = Invoice::latest()->first()->id;
        Invoicedetail::create([
            'id_Invoice'        => $invoice_id,
            'invoice_number'    => $request->invoice_number,
            'product'           => $request->product,
            'Section'           => $request->Section,
            'Status'            => 'غير مدفوعة',
            'Value_Status'      => 2,
            'note'              => $request->note,
            'user'              => (Auth::user()->name),
        ]);

        if ($request->hasFile('pic')) {
            $invoice_id = Invoice::latest()->first()->id;
            $invoice_number = $request->invoice_number;
            $filename = time() . '.' . $request->pic->extension(); // you can use getClientOriginalName() function
            $path = 'uploads';
            $request->pic->move(public_path($path . '/' . $invoice_number), $filename);
            Invoiceattachment::create([
                'file_name' => $filename,
                'invoice_number' => $request->invoice_number,
                'Created_by' => (Auth::user()->name),
                'invoice_id' => $invoice_id,
            ]);
        }

        // $user = User::first();//  اليوزر اللى فاتح
        // Notification::send($user, new Addinvoice($invoice_id));

        $user = User::get();//مين اليوزر اللى ضاف الفاتوره
        $invoices = Invoice::latest()->first();
        Notification::send($user, new \App\Notifications\Addinvoicenew($invoices));
        // event(new MyEventClass('hello world'));

        return redirect()->route('invoices.index')->with(['add' => 'تم الاضافه بنجاح']);
    }

    public function show($id)
    {

    }



    public function edit($id)
    {
        $invoice = Invoice::find($id);
        if(!$invoice)
        return redirect()->route('invoices.index')->with(['notfound' => 'غير موجود']);
        $sections = Section::all();
        return view('invoices.edit',compact('invoice','sections'));
    }


    public function update(InvoiceRequest $request, $id)
    {
        $invoice = Invoice::find($id);
        if(!$invoice)
        return redirect()->route('invoices.index')->with(['notfound' => 'غير موجود']);

        $invoice->update([
            'invoice_number'    => $request->invoice_number,
            'invoice_Date'      => $request->invoice_Date,
            'Due_date'          => $request->Due_date,
            'product'           => $request->product,
            'section_id'        => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount'          => $request->Discount,
            'Value_VAT'         => $request->Value_VAT,
            'Rate_VAT'          => $request->Rate_VAT,
            'Total'             => $request->Total,
            'note'              => $request->note,
        ]);

        return redirect()->route('invoices.index')->with(['update' => 'تم التحديث  بنجاح']);
    }

    public function deleteInvoice($id)
    {
        $invoice = Invoice::find($id);
        if(!$invoice)
        return redirect()->route('invoices.index')->with(['error' => 'غير موجود']);
        return view('invoices.formdeleteinvoice',compact('invoice'));

    }

    public function destroy($id)
    {
        $invoice = Invoice::find($id);
        if(!$invoice)
        return redirect()->route('invoices.index')->with(['notfound' => 'غير موجود']);

        $attachments = Invoiceattachment::where('invoice_id',$id)->first();

        if(!empty($attachments->invoice_number))
        {
            $pathToFile = public_path('uploads/'. $attachments->invoice_number);
            File::deleteDirectory($pathToFile);
        }

        $invoice->forceDelete();
        return redirect()->route('invoices.index')->with(['delete' => 'تم الحذف بنجاح']);
    }

    public function changeStatus($id)
    {
        $invoice = Invoice::find($id);
        if(!$invoice)
        return redirect()->route('invoices.index')->with(['notfound' => 'غير موجود']);
        return view('invoices.changestatus',compact('invoice'));
    }

    public function statusUpdate($id,Request $request)
    {

        $invoice = Invoice::findOrFail($id);

        if ($request->Status === 'مدفوعة') {

            $invoice->update([
                'Value_Status' => 1,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date,
            ]);

            Invoicedetail::create([
                'id_Invoice' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->Section,
                'Status' => $request->Status,
                'Value_Status' => 1,
                'note' => $request->note,
                'Payment_Date' => $request->Payment_Date,
                'user' => (Auth::user()->name),
            ]);
        }

        else {
            $invoice->update([
                'Value_Status' => 3,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date,
            ]);
            Invoicedetail::create([
                'id_Invoice' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->Section,
                'Status' => $request->Status,
                'Value_Status' => 3,
                'note' => $request->note,
                'Payment_Date' => $request->Payment_Date,
                'user' => (Auth::user()->name),
            ]);
        }
        return redirect()->route('invoices.index')->with(['update' => 'تم التحديث بنجاح']);
    }

    public function invoicePrint($id)
    {
        // $invoice = Invoice::where('id',$id)->first();
        $invoice = Invoice::find($id);
        if(!$invoice)
        return redirect()->route('invoices.index')->with(['notfound' => 'غير موجود']);

        return view('invoices.printinvoice',compact('invoice'));
    }


    public function markasreadall (Request $request)
    {

        $userUnreadNotification= auth()->user()->unreadNotifications;

        if($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return back();
        }


    }
}
