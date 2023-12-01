<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionGroup;
use App\Models\Test;
use Illuminate\Http\Request;

class ListeningTestController extends Controller
{
    public function index(Request $request, $id)
    {
        // dd(Question::where('test_id', $id)->get());
        $test = Test::where('id', $id)->with('questions')->first();
        $questionsGroup = QuestionGroup::where('test_id', $test->id)->with('questions')->wherehas('questions', function ($query) {
            $query->where('type',2);
        })->orderBy('position', 'asc')->get();
      

        $organizedData = [];

        // Separate questions by paragraph within their respective question groups
        $questionsGroup->each(function ($questionGroup) use (&$organizedData) {
            $paragraphId = $questionGroup->questions->first()->paragraph;

            // Initialize the arrays if not set
            $organizedData[$paragraphId]['questionGroups'] ??= collect();

            // Add the question group to the corresponding collection based on paragraph ID
            $organizedData[$paragraphId]['questionGroups']->push([
                'questionGroup' => $questionGroup,
                'questions' => $questionGroup->questions,
            ]);
        });

        $data =  $organizedData;

        return view('frontend.pages.listening-test.index', compact('test', 'data'));
    }
    public function show(Request $request, $id)
    {
        $test = Test::findOrFail($id);

        return view('frontend.pages.listening-test.partials.show', compact('test'));
    }
}
