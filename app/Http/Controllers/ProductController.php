<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;


class ProductController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:المنتجات', ['only' => ['index']]);

        //التلاته دول مش بنوصلهم عن طريق فنكشن بنوص عن طريق المودولا فممكن متحطهمش
        // $this->middleware('permission:اضافة منتج', ['only' => ['create', 'store']]);
        // $this->middleware('permission:تعديل منتج', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:حذف منتج', ['only' => ['destroy']]);
    }

    public function index()
    {
        $sections = Section::all();
        $products = Product::with('section')->get();
        return view('products.products',compact('sections','products'));
    }


    public function create()
    {
        //
    }



    public function store(ProductRequest $request)
    {
        Product::create([
            'product_name' => $request ->product_name,
            'section_id'   => $request ->section_id,
            'description'  => $request ->description,
        ]);

        return redirect()->route('products.index')->with(['success'=>'تم الاضافه بنجاح']);
    }


    public function show(Product $product)
    {
        //
    }


    public function edit(Product $product)
    {
        //
    }


    public function update(Request $request)
    {
        $request->validate([
            'product_name' => 'required|unique:products,product_name|max:255,'.$request->id,
            'section_name' => 'required',
            'description' => 'required',
        ],[
            'product_name.required' => 'اسم المنتج  مطلوب',
            'product_name.unique' => ' اسم المنتج موجود بالفعل حاول مره اخرى',
            'product_name.max' => 'اسم المنتج  لايجب ان يذيد عن 255 حرف',
            'section_name.required' => 'اسم القسم  مطلوب',
            'description.required' => '  الوصف مطلوب',
        ]);

        $id = Section::where('section_name',$request->section_name)->first()->id;
        $product = Product::findOrFail($request -> id);

        $product ->update([
            'product_name' => $request -> product_name,
            'section_id'   => $id,
            'description'  => $request -> description,
        ]);
        return redirect()->route('products.index')->with(['success' => 'تم التحديث بنجاح']);

    }


    public function destroy(Request $request)
    {
        $product = Product::find($request ->id);
        if(!$product)
        {
            return redirect()->route('products.index')->with(['error' => 'هذا المنتج غير موجود']);
        }

        $product->delete();
        return redirect()->route('products.index')->with(['success' => 'تم الحذف بنجاح']);

    }
}
