<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class TestController extends Controller
{

    public function index()
    {
        $sections = Test::all();
        return view('tests.index',compact('sections'));
    }


    public function create()
    {
        return view('tests.create');
    }


    public function store(Request $request)
    {
        Test::create([
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => Auth::user()->name
        ]);
        return redirect()->route('test.create')->with(['success' => 'تم الاضافه بنجاح']);
    }


    public function show($id)
    {
        return 'show';
    }


    public function edit($id)
    {
        $section = Test::find($id);
        if(!$section)
        return redirect()->route('test.index')->with(['error' => 'غير موجود']);
        $section = Test::find($id);
        return view('tests.edit',compact('section'));
    }


    public function update(Request $request,$id)
    {
        $section = Test::find($id);
        if(!$section)
        return redirect()->route('test.index')->with(['error' => 'غير موجود']);

        $section->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->route('test.index')->with(['success' => 'تم التحديث بنجاح']);
    }

    // public function formDelete($id)
    // {
    //     #########################################الحذف براوت خارجى ثم فانكشن خارجيه لا يتم فيها الحذف مباشرة بل كل وظيفتها انها تجيبلى فيو فورم      #######################################
    //     $section = Test::find($id);
    //     if(!$section)
    //     return redirect()->route('test.index')->with(['error' => 'غير موجود']);
    //     return view('tests.formdelete',compact('section'));

    // }


    // public function formDelete($id)
    // {

    //     #########################################الحذف براوت خارجى ثم فانكشن خارجيه يتم فيها الحذف مباشرة دون الحاجه الى فيو اخر او فورم اخرى #######################################
    //     $section = Test::find($id);
    //     if(!$section)
    //     return redirect()->route('test.index')->with(['error' =>'غير موجود']);

    //     $section = Test::find($id);
    //     $section->delete();
    //     return redirect()->route('test.index')->with(['success' =>'تم الحذف بنجاح']);
    // }

    public function destroy($id)
    {
        #####################################راوت خارجى ثم فانكشن خارجيه اسمها ديستروى وبكدا استغلينا الريسورس على طول افضل طريقه#####################################
        $section = Test::find($id);
        if(!$section)
        return redirect()->route('test.index')->with(['error' =>'غير موجود']);

        $section = Test::find($id);
        $section->delete();
        return redirect()->route('test.index')->with(['success' =>'تم الحذف بنجاح']);
    }

}
