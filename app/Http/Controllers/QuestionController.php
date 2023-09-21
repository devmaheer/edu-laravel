<?php

namespace App\Http\Controllers;

use App\Models\FillInBlank;
use App\Models\Option;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;


class QuestionController extends Controller
{

   public function index(Request $request, $id)
   {

      $test = Test::where('id', $id)->with('questions')->first();
      $paraCount1 = Question::where('test_id', $id)->where('paragraph',1)->count();
      $paraCount2 = Question::where('test_id', $id)->where('paragraph',2)->count();
      $paraCount3 = Question::where('test_id', $id)->where('paragraph',3)->count();
      $paraCount4 = Question::where('test_id', $id)->where('paragraph',4)->count();
      $paraCount5 = Question::where('test_id', $id)->where('paragraph',5)->count();
      return view('admin.question.reading.index', compact('test','paraCount1','paraCount2','paraCount3','paraCount4','paraCount5'));
   }

   public function  create(Request $request, $id, $type)
   {
   }
   public function  store(Request $request)
   {

      if ($request->question_type == "reading") {
         if ($request->filling_blanks == '1') {

            $this->storeFillingBlanks($request);
         } else {
            $this->storeMcqs($request);
         }
         return  redirect()->back();
      }
   }
   public function storeMcqs($request)
   {
      $question = Question::create([
         'name' => $request->mcqs_name,
         'test_id' => $request->testId,
         'paragraph' => $request->paragraph,
         'category' => 1,
         'type' => 1,
      ]);
      // dd($request->all());

      foreach ($request->options['name'] as $key => $name) {

         Option::create([
            'name' => $name,
            'question_id' => $question->id,
            'is_correct' => $request->options['trueValue'][$key] == $name ? 1 : 0,
         ]);
      }
   }
   public function storeFillingBlanks($request)
   {
      $question = Question::create([
         'name' => $request->fill_1,
         'test_id' => $request->testId,
         'paragraph' => $request->paragraph,
         'category' => 2,
         'type' => 1,
      ]);
      FillInBlank::create([
         'question_id' => $question->id,
         "fill_1" => $request->fill_1,
         "ans_1" => $request->ans_1,
         "fill_2" => $request->fill_2,
         "ans_2" => $request->ans_2,
         "fill_3" => $request->fill_3,
         "ans_3" => $request->ans_3,
         "fill_4" => $request->fill_4,
      ]);
   }

   public function edit(Request $request, $id)
   {

      $question = Question::where('id', $id)->with('options', 'test')->first();

      return view('admin.question.reading.edit', compact('question'));
   }
   public function editFillInBlanks(Request $request, $id)
   {

      $question = Question::where('id', $id)->with('fillInBlank', 'test')->first();

      return view('admin.question.reading.edit-fillinblanks', compact('question'));
   }
   public function  update(Request $request)
   {

      if ($request->question_type == "reading") {

         if ($request->filling_blanks == '1') {
            $question=  $this->updateFillInBlank($request);
            return  redirect()->route('admin.question.index', ['id' => $question->test->id]);
         } else {
           $question = $this->updateMcqs($request);
            return  redirect()->route('admin.question.index', ['id' => $question->test->id]);
         }
      }
   }

   public function updateMcqs($request)
   {
      $test = Test::findOrFail($request->testId);

      Question::where('id', $request->questionId)->update([
         'name' => $request->mcqs_name,
         'test_id' => $request->testId,
         'paragraph' => $request->paragraph,
         'category' => 1,
         'type' => 1,
      ]);

      $question = Question::findOrFail($request->questionId);
      Option::where('question_id', $question->id)->delete();
      foreach ($request->options['name'] as $key => $name) {

         Option::create([
            'name' => $name,
            'question_id' => $question->id,
            'is_correct' => $request->options['trueValue'][$key] == $name ? 1 : 0,
         ]);
      }
      return $question;
   }

   public function updateFillInBlank($request)
   {
      Question::where('id', $request->questionId)->update([
         'name' => $request->fill_1,
         'test_id' => $request->testId,
         'paragraph' => $request->paragraph,
         'category' => 2,
         'type' => 1,
      ]);
      $question = Question::findOrFail($request->questionId);
      FillInBlank::where('id', $question->fillInBlank->id)->update([
         'question_id' => $question->id,
         "fill_1" => $request->fill_1,
         "ans_1" => $request->ans_1,
         "fill_2" => $request->fill_2,
         "ans_2" => $request->ans_2,
         "fill_3" => $request->fill_3,
         "ans_3" => $request->ans_3,
         "fill_4" => $request->fill_4,
      ]);
     return $question;
   }

   public function delete($id)
   {
      $question = Question::findOrFail($id);
      Option::where('question_id', $id)->delete();
      $question->delete();
      return  redirect()->route('admin.question.index', ['id' => $question->test->id]);
   }
}
