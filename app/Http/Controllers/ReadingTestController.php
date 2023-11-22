<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionGroup;
use App\Models\Test;
use Illuminate\Http\Request;

class ReadingTestController extends Controller
{

    public function index(Request $request, $id)
    {

        $test = Test::where('id', $id)->with('questions')->first();
        $questionsGroup = QuestionGroup::where('test_id', $test->id)->with('questions')->wherehas('questions', function ($query) {
            $query->WhereNotNull('paragraph')->orderBy('paragraph', 'asc');
        })->orderBy('position', 'asc')->get();


        $organizedData = [];

        // Separate questions by paragraph within their respective question groups
        $questionsGroup->each(function ($questionGroup) use (&$organizedData) {
            $paragraphId = $questionGroup->questions->first()->paragraph;

            // Initialize the arrays if not set
            $organizedData[$paragraphId]['questionGroups'] ??= collect();
            $organizedData[$paragraphId]['paragraph'] = $paragraphId;

            // Add the question group to the corresponding collection based on paragraph ID
            $organizedData[$paragraphId]['questionGroups']->push([
                'questionGroup' => $questionGroup,
                'questions' => $questionGroup->questions,
            ]);
        });

        $data =  $organizedData;

        return view('frontend.pages.reading-test.index', compact('test', 'data'));
    }

    public function finish(Request $request)
    {
        dd($request->all());
    }
}
