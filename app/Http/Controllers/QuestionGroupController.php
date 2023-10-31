<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionGroup;
use App\Models\Test;
use Illuminate\Http\Request;

class QuestionGroupController extends Controller
{
    //

    public function index(Request $request, $id)
    {

       
        if ($request->type == 'reading') {
            $questionGroup = QuestionGroup::where('type',1)->where('test_id', $id)->get();
            $test = Test::findOrFail($id);
            return view('admin.question-group.reading.index', compact('test', 'questionGroup'));
        } else {
            $questionGroup = QuestionGroup::where('type',2)->where('test_id', $id)->get();
            $test = Test::findOrFail($id);
            return view('admin.question-group.listening.index', compact('test', 'questionGroup'));
        }
    }

    public function create(Request $request, $id)
    {
        if ($request->type == 'reading') {
            $test = Test::where('id', $id)->with(['questions' => function ($query) {
                $query->where('question_group_id',null)->where('type', 1);
            }])->first();
            return view('admin.question-group.reading.create', compact('test'));
        }else{
            $test = Test::where('id', $id)->with(['questions' => function ($query) {
                $query->where('question_group_id',null)->where('type', 2);
            }])->first(); 
            return view('admin.question-group.listening.create', compact('test'));
        }

          
       
    }

    public function store(Request $request)
    {
        if($request->type == 'reading'){
              $position = QuestionGroup::where('type',1)->where('test_id',$request->testId)->max('position');
           
            $group = QuestionGroup::create([
                'heading' => $request->name,
                'test_id' => $request->testId,
                'type' =>1,
                'description' => $request->description,
                'position'=> $position == null ? 1 : $position + 1,
            ]);

            $question = Question::whereIn('id', $request->questionChecked)->update(['question_group_id' => $group->id]);


           return redirect()->route('admin.question.group.index',['id' => $request->testId,'type' => 'reading']);
        }else{
            $position = QuestionGroup::where('type',2)->where('test_id',$request->testId)->max('position');
              
            $group = QuestionGroup::create([
                'heading' => $request->name,
                'test_id' => $request->testId,
                'type' =>1,
                'description' => $request->description,
                'position'=> $position == null ? 1 : $position + 1,
            ]);

            $question = Question::whereIn('id', $request->questionChecked)->update(['question_group_id' => $group->id]);


           return redirect()->route('admin.question.group.index',['id' => $request->testId,'type' => 'listening']);

        }
  
    
       

      
    }

    public function delete(Request $request,$id)
    {
        $group = QuestionGroup::findOrFail($id);
        $group->delete();
        $question = Question::where('question_group_id', $id)->update([
            'question_group_id' => null,
            'position' => null,
        ]);
      
      
        if ($request->type == "reading") {
            return redirect()->route('admin.question.group.index',['id' => $group->test_id,'type' => 'reading']);
        } else {
            return redirect()->route('admin.question.group.index',['id' => $id,'type' => 'listening']);
        }
       
    }
}
