<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Shark;

class sharkController extends Controller
{

    public function index()
    {
        // get all the sharks
        $sharks = shark::all();

        // load the view and pass the sharks
        return view('sharks.index',compact('sharks'));

    }



    public function create()
    {
        // load the create form (app/views/sharks/create.blade.php)
        return view('sharks.create');
    }


    public function store(Request $request)
    {
            // store
            Shark::create([
                'name' => $request->name,
                'email' => $request->email,
                'shark_level' => $request->shark_level,
            ]);
            return "successfully from store";
    }


    public function show($id)
    {
        $shark = shark::find($id);

        return view('sharks.show',compact('shark'));

    }


    public function edit($id)
    {
        $shark = shark::find($id);

        return view('sharks.edit',compact('shark'));
    }

    public function update(Request $request,$id)
    {
        // use Illuminate\Support\Facades\Validator;//خد بالك من التضمين لازم نضمن دا مادام هنعمل فاليداشن
        // $request->validate([
        //             'id' => 'required|exists:sharks,id'.$request->id,
        //         ],[
        //             'id.required' => 'اسم الشارك  مطلوب',
        //             'id.exists' => 'اسم الشارج ليس موجود',
        //         ]);

            //$shark = shark::find($request->id);this we will use in validation (append & exists|sharks,id)
            $shark = shark::find($id);
            if(!$shark)
            return redirect()->route('sharks.index')->with(['error' =>'لايوحد']);


            $shark->update([
                'name' => $request->name,
                'email' => $request->email,
                'shark_level' => $request->shark_level,
            ]);

            echo 'updated successfully';
        }



    public function destroy($id)
    {
        //
    }

    public function test()
    {
        return "test";
    }
}
