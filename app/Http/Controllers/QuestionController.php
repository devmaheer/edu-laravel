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
    
      if ($request->listening == 'true') {
         $questions = Question::where('test_id', $id)->where('type', 2)->get();

         return view('admin.question.listening.index', compact('test', 'questions'));
      }
      $questions = Question::where('test_id', $id)->where('type', 1)->get();
      $paraCount1 = Question::where('test_id', $id)->where('type', 1)->where('paragraph', 1)->count();
      $paraCount2 = Question::where('test_id', $id)->where('type', 1)->where('paragraph', 2)->count();
      $paraCount3 = Question::where('test_id', $id)->where('type', 1)->where('paragraph', 3)->count();
      $paraCount4 = Question::where('test_id', $id)->where('type', 1)->where('paragraph', 4)->count();
      $paraCount5 = Question::where('test_id', $id)->where('type', 1)->where('paragraph', 5)->count();
      return view('admin.question.reading.index', compact('test', 'questions', 'paraCount1', 'paraCount2', 'paraCount3', 'paraCount4', 'paraCount5'));
   }

   public function  create(Request $request, $id, $type)
   {
   }
   public function  store(Request $request)
   {
 
      if ($request->question_type == "reading") {
         if ($request->filling_blanks == '1') {

            $this->storeFillingBlanks($request, 1);
         } else {
            $this->storeMcqs($request, 1);
         }
         return  redirect()->back();
      } else {
         if ($request->filling_blanks == '1') {

            $this->storeFillingBlanks($request, 2);
         } else {
            $this->storeMcqs($request, 2);
         }
         return  redirect()->back();
      }
   }
   public function storeMcqs($request, $type)
   {

      $question = Question::create([
         'name' => $request->mcqs_name,
         'test_id' => $request->testId,
         'part' => $request->part ? : null,
         'paragraph' => $request->paragraph,
         'category' => $request->option_number == '5' ? 3 :  1,
         'type' => $type,
      ]);

      foreach ($request->options['name'] as $key => $name) {

         Option::create([
            'name' => $name,
            'question_id' => $question->id,
            'is_correct' => $request->options['trueValue'][$key] == $name ? 1 : 0,
         ]);
      }
   }
   public function storeFillingBlanks($request, $type)
   {
      $imageUrl = null;
      if ($request->has('image')) {
         $image = $request->file('image');
         $filename = uniqid() . '.' . $image->getClientOriginalExtension();
         $image->move(public_path() . '/storage', $filename);
         $imageUrl = asset('storage/' . $filename);
         // You can also generate a public URL for the stored image


      }

      $question = Question::create([
         'name' => $request->fill_1,
         'test_id' => $request->testId,
         'paragraph' => $request->paragraph,
         'category' => 2,
         'image_url' => $imageUrl,
         'part' => $request->part ? : null,
         'type' => $type,
      ]);
      FillInBlank::create([
         'question_id' => $question->id,
         "fill_1" =>$request->fill_1,
         "ans_first_1" => strtolower($request->ans_first_1),
         "ans_first_2" => strtolower($request->ans_first_2),
         "ans_first_3" => strtolower($request->ans_first_3),
         "fill_2" => $request->fill_2,
         "ans_sec_1" => strtolower($request->ans_sec_1),
         "ans_sec_2" => strtolower($request->ans_sec_2),
         "ans_sec_3" => strtolower($request->ans_sec_3),
         "fill_3" => $request->fill_3,
         "ans_third_1" => strtolower($request->ans_third_1),
         "ans_third_2" => strtolower($request->ans_third_2),
         "ans_third_3" => strtolower($request->ans_third_3),
         "fill_4" =>$request->fill_4,
      ]);
   }

   public function edit(Request $request, $id)
   {

      $question = Question::where('id', $id)->with('options', 'test')->first();
      if ($request->listening == 'true') {
         return view('admin.question.listening.edit', compact('question'));
      }
      return view('admin.question.reading.edit', compact('question'));
   }
   public function editFiveOptions(Request $request, $id){
      if($request->listening == 'true'){
         $question = Question::where('id', $id)->with('options', 'test')->first();
         return view('admin.question.listening.partials.five-options-edit', compact('question')); 
      }
      if($request->type == 'reading'){
         $question = Question::where('id', $id)->with('options', 'test')->first();
      return view('admin.question.reading.partials.five-options-edit', compact('question')); 
      }
     
   }
   public function editFillInBlanks(Request $request, $id)
   {

      $question = Question::where('id', $id)->with('fillInBlank', 'test')->first();
      if ($request->listening == 'true') {
         return view('admin.question.listening.edit-fillinblanks', compact('question'));
      }
      return view('admin.question.reading.edit-fillinblanks', compact('question'));
   }
   public function  update(Request $request)
   {
    
      if ($request->question_type == "reading") {
          
         if ($request->filling_blanks == '1') {
            $question =  $this->updateFillInBlank($request, 1);
            return  redirect()->route('admin.question.index', ['id' => $question->test->id]);
         } else {
            $question = $this->updateMcqs($request, 1);
            return  redirect()->route('admin.question.index', ['id' => $question->test->id]);
         }
      } else {
         if ($request->filling_blanks == '1') {
            $question =  $this->updateFillInBlank($request, 2);
            return  redirect()->route('admin.question.index', ['id' => $question->test->id, 'listening' => 'true']);
         } else {
            $question = $this->updateMcqs($request, 2);
            return  redirect()->route('admin.question.index', ['id' => $question->test->id, 'listening' => 'true']);
         }
      }
   }

   public function updateMcqs($request, $type)
   {
    
      $test = Test::findOrFail($request->testId);

      Question::where('id', $request->questionId)->update([
         'name' => $request->mcqs_name,
         'test_id' => $request->testId,
         'paragraph' => $request->paragraph,
         'part' => $request->part ? : null,
         'category' => $request->option_number == '5' ? 3 :  1,
         'type' => $type,
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

   public function updateFillInBlank($request, $type)
   {
      $imageUrl = null;
     
      if ($request->has('image')) {

         $image = $request->file('image');
         $filename = uniqid() . '.' . $image->getClientOriginalExtension();
         $image->move(public_path() . '/storage', $filename);
         $imageUrl = asset('storage/' . $filename);
         // You can also generate a public URL for the stored image
      }else{
         $imageUrl =  $request->old_image;

      }

      Question::where('id', $request->questionId)->update([
         'name' => $request->fill_1,
         'test_id' => $request->testId,
         'paragraph' => $request->paragraph,
         'category' => 2,
         'image_url' => $imageUrl,
         'part' => $request->part ? : null,
         'type' => $type,
      ]);
      $question = Question::findOrFail($request->questionId);
      FillInBlank::where('id', $question->fillInBlank->id)->update([
         'question_id' => $question->id,
         "fill_1" => $request->fill_1,
         "ans_first_1" => strtolower($request->ans_first_1),
         "ans_first_2" => strtolower($request->ans_first_2),
         "ans_first_3" => strtolower($request->ans_first_3),
         "fill_2" => $request->fill_2,
         "ans_sec_1" => strtolower($request->ans_sec_1),
         "ans_sec_2" => strtolower($request->ans_sec_2),
         "ans_sec_3" => strtolower($request->ans_sec_3),
         "fill_3" => $request->fill_3,
         "ans_third_1" => strtolower($request->ans_third_1),
         "ans_third_2" => strtolower($request->ans_third_2),
         "ans_third_3" => strtolower($request->ans_third_3),
         "fill_4" => $request->fill_4,
      ]);
      return $question;
   }

   public function delete(Request $request, $id)
   {

      $question = Question::findOrFail($id);
      Option::where('question_id', $id)->delete();
      $question->delete();
      if ($request->type == "reading") {
         return  redirect()->route('admin.question.index', ['id' => $question->test->id]);
      } else {
         return  redirect()->route('admin.question.index', ['id' => $question->test->id, 'listening' => 'true']);
      }
   }
}
