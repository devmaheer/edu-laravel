<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
  //

  public function index(Request $request)
  {
    $tests = Test::get();
    return view('admin.test.index', compact('tests'));
  }

  public function create(Request $request)
  {


    return view('admin.test.create');
  }


  public function store(Request $request)
  {
     
    Test::create([
      'name' => $request->name,
      'status' => $request->status,
      'type' => $request->type,
      'category' => $request->category,
    ]);
    return redirect()->route('admin.test.index');
  }

  public function edit(Request $request, $id)
  {
    $test = Test::findOrFail($id);

    return view('admin.test.edit', compact('test'));
  }

  public function update(Request $request)
  {

    $test =   Test::where('id', $request->id)->update([
      'name' => $request->name,
      'status' => $request->status,
      'type' => $request->type,
      'category' => $request->category,
    ]);
    return redirect()->route('admin.test.index');
  }

  public function delete($id)
  {
    $test = Test::findOrFail($id);
    $test->delete();
    return redirect()->route('admin.test.index');
  }

  public function  createParagraph(Request $request, $id, $type)
  {

    $test = Test::findOrFail($id);
    if ($type == 'reading') {

      return view('admin.question.reading.create-paragraph', compact('test'));
    }
  }

  public function  paragraphStore(Request $request)
  {

    if ($request->type == "reading") {

      $test = Test::findOrFail($request->testId);
      $test->paragraph1 = $request->paragraph1;
      $test->paragraph2 = $request->paragraph2;
      $test->paragraph3 = $request->paragraph3;
      $test->paragraph4 = $request->paragraph4;
      $test->paragraph5 = $request->paragraph5;
      $test->save();

      return  redirect()->route('admin.question.index', ['id' => $test->id]);
    }
  }
  public function  createAudio(Request $request, $id, $type)
  {

    $test = Test::findOrFail($id);


    return view('admin.question.listening.create-audio', compact('test'));
  }
  public function audioStore(Request $request)
  {
    $test = Test::findOrFail($request->testId);
    $audioUrl= $request->audio_url;
    if ($request->has('audio')) {
       $audio = $request->file('audio');
       $filename = uniqid() . '.' . $audio->getClientOriginalExtension();
       $audio->move(public_path().'/storage/audio', $filename);
       $audioUrl = asset('storage/audio/'.$filename);  
   
    }
   $test->audio =  $audioUrl;
   $test->save();
   return redirect()->back();
  }
}
