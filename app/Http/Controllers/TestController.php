<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //

    public function index(Request $request){
    $tests = Test::get();
     return view('admin.test.index', compact('tests'));
    }

    public function create(Request $request){

   
        return view('admin.test.create');
       }


       public function store(Request $request){
      
         Test::create([
            'name'=>$request->name,
            'status'=>$request->status,
            'type'=>$request->type,
            'category'=>$request->category,
         ]);
         return redirect()->route('admin.test.index');
       }

       public function edit(Request $request,$id){
        $test = Test::findOrFail($id);

        return view('admin.test.edit', compact('test'));
       }

       public function update(Request $request){
      
      $test =   Test::where('id',$request->id)->update([
           'name'=>$request->name,
           'status'=>$request->status,
           'type'=>$request->type,
           'category'=>$request->category,
        ]);
       return redirect()->route('admin.test.index');
      }

      public function delete($id){
        $test = Test::findOrFail($id);
        $test->delete();
        return redirect()->route('admin.test.index');
       }
}
