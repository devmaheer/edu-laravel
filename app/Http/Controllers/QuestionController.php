<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Editor\Fields\Options;

class QuestionController extends Controller
{
    //cr
    public function index(Request $request ,$id){

       $test = Test::where('id',$id)->with('questions')->first();
      
       return view('admin.question.writing.index',compact('test'));
    }

    public function  create(Request $request ,$id,$type){
    
       
       
     }
     public function  store(Request $request){
    
        if($request->question_type == "writing"){
         
            $test = Test::findOrFail($request->testId);
           $question = Question::create([
              'name'=>$request->mcqs_name,
              'test_id'=>$request->testId,
              'type'=> 1,
            ]);
            // dd($request->all());

            foreach($request->options['name'] as $key => $name){
              
                Option::create([
                 'name' => $name,
                 'question_id'=>$question->id,
                 'is_correct'=>$request->options['trueValue'][$key] == $name ? 1:0,
                ]);
            }

            return  redirect()->back();
        }
        if($request->type == "listening"){
          
            $test = Test::findOrFail($request->testId);
            $test->paragraph = $request->paragraph;
            $test->save();

            return  redirect()->back();
        }
   
       
     }
}
