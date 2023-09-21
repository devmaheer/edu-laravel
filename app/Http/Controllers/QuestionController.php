<?php

namespace App\Http\Controllers;

use App\Models\FillInBlank;
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
      
       return view('admin.question.reading.index',compact('test'));
    }

    public function  create(Request $request ,$id,$type){
    
       
       
     }
     public function  store(Request $request){
    
        if($request->question_type == "reading"){
          if($request->filling_blanks == '1'){
          
           $question = Question::create([
            'name'=>$request->fill_1,
            'test_id'=>$request->testId,
             'paragraph'=>$request->paragraph,
            'type'=> 1,
          ]);
          FillInBlank::create([
            'question_id'=>$question->id,
            "fill_1" => $request->fill_1,
            "ans_1" => $request->ans_1,
            "fill_2" => $request->fill_2,
            "ans_2" => $request->ans_2,
            "fill_3" => $request->fill_3,
            "ans_3" => $request->ans_3,
            "fill_4" =>$request->fill_4,
          ]);
          return  redirect()->back();
          }else{
          
           $question = Question::create([
              'name'=>$request->mcqs_name,
              'test_id'=>$request->testId,
               'paragraph'=>$request->paragraph,
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
        }
  
     }

     public function edit(Request $request,$id){
       
        $question = Question::where('id',$id)->with('options','test')->first();
       
        return view('admin.question.reading.edit',compact('question'));
     }

     public function  update(Request $request){
      
        if($request->question_type == "reading"){
        
            $test = Test::findOrFail($request->testId);
           
           Question::where('id',$request->questionId)->update([
              'name'=>$request->mcqs_name,
              'test_id'=>$request->testId,
              'paragraph'=>$request->paragraph,
              'type'=> 1,
            ]);
           
            $question = Question::findOrFail($request->questionId);
            Option::where('question_id',$question->id)->delete();
            foreach($request->options['name'] as $key => $name){
              
                Option::create([
                 'name' => $name,
                 'question_id'=>$question->id,
                 'is_correct'=>$request->options['trueValue'][$key] == $name ? 1:0,
                ]);
            }
            return  redirect()->route('admin.question.index',['id'=>$question->test->id]);
        }
        
     }

     public function delete($id){
        $question = Question::findOrFail($id);
        Option::where('question_id',$id)->delete();
        $question->delete();
        return  redirect()->route('admin.question.index',['id'=>$question->test->id]);
     }
}
