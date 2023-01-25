<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Requests\SectionRequest;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:الاقسام', ['only' => ['index']]);
        //التلاته دول مش بنوصلهم عن طريق فنكشن بنوص عن طريق المودولا فممكن متحطهمش
        // $this->middleware('permission:اضافة قسم', ['only' => ['create', 'store']]);
        // $this->middleware('permission:تعديل قسم', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:حذف قسم', ['only' => ['destroy']]);
    }


    public function index()
    {
        $sections = Section::all();
        return view('sections.sections',compact('sections'));
    }


    public function create()
    {
        //
    }


    public function store(SectionRequest $request)
    {


        // // فقط هذا ويعرض لك رسائل لارافيل الديفولت لو ما حطيتها انت +فى البليد تروح تعرض الرساله وشكرا
        // $validated = $request->validate([
        //     'section_name' => 'required|unique:sections|max:255',
        //     'description' => 'required',
        // ],[
        //     'section_name.required' => 'اسم القسم  مطلوب',
        //     'description.required' => '  الوصف مطلوب',
        //     'section_name.unique' => ' اسم القسم موجود بالفعل حاول مره اخرى',
        //     'section_name.max' => 'اسم القسم  لايجب ان يذيد عن 255 حرف',
        // ]);

        Section::create([
            'section_name' => $request->section_name,
            'description' => $request->description,
            'created_by' => Auth::user()->name,

        ]);
        return redirect()->route('sections.index')->with(['success' => 'تمت الاضافه بنجاح']);
    }

    public function show(Section $section)
    {
        //
    }


    public function edit(Section $section)
    {
        //
    }


    public function update(Request $request,$id)
    {
        // فقط هذا ويعرض لك رسائل لارافيل الديفولت لو ما حطيتها انت +فى البليد تروح تعرض الرساله وشكرا
        $request->validate([
            'section_name' => 'required|max:255|unique:sections,section_name,'.$request ->id,
            'description' => 'required',
        ],[
            'section_name.required' => 'اسم القسم  مطلوب',
            'description.required' => '  الوصف مطلوب',
            'section_name.unique' => ' اسم القسم موجود بالفعل حاول مره اخرى',
            'section_name.max' => 'اسم القسم  لايجب ان يذيد عن 255 حرف',
        ]);

        $section = Section::find($request ->id);
        // $section = Section::find($id);
        if(!$section)
        {
            return redirect()->route('sections.index')->with(['error' => 'هذا القسم غير موجود موجود حاول مرة اخرى']);
        }

        $section->update([
            'section_name' => $request -> section_name,
            'description' => $request -> description,
        ]);

        return redirect()->route('sections.index')->with(['success' => 'تم التحديث بنجاح']);
    }


    public function destroy(Request $request)
    {
        $section = Section::find($request -> id);
        if(!$section)
        return redirect()->route('sections.index')->with(['error' => 'هذا القسم غير موجود']);

        $section->delete();
        return redirect()->route('sections.index')->with(['success' =>'تم الحذف بنجاح']);
    }
}
