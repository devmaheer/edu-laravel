<?php

namespace App\Http\Controllers;

use App\Models\FinishedTest;
use App\Models\Question;
use App\Models\QuestionGroup;
use App\Models\Test;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FinishedTestController extends Controller
{

    public function getCountdownValue(Request $request)
    {
        // Get the current countdown value
        $countdownValue = null;

        if (Session::has('countdowntime')) {
            $initialCountdownTime = 60 * 60; // 60 minutes in seconds
            $countdowntime = Carbon::parse(Session::get('countdowntime'));
            $currentTime = Carbon::now();

            $elapsedTime = $currentTime->diffInSeconds($countdowntime);
            $remainingTime = max(0, $initialCountdownTime - $elapsedTime);
            $countdownValue = $remainingTime;
        } else {
            // Set countdowntime to current time
            $countdowntime = Carbon::now();
            Session::put('countdowntime', $countdowntime);
        }

        return response()->json(['countdownValue' => $countdownValue]);
    }

    public function score(Request $request, $id)
    {
        $finishtest = FinishedTest::where('id', $id)->first();
        $test = $finishtest->tests;

        $totalFiveChoice = Question::where('test_id', $test->id)->where('category', 3)->count();
        $totalFills = Question::where('test_id', $test->id)->where('type', 1)->where('category', 2)->count();

        $totalMcqs = Question::where('test_id', $test->id)->where('type', 1)->where('category', 1)->count();

        $fiveChoicePercentage = floor(($finishtest->five_choice_score / ($totalFiveChoice + $totalFiveChoice)) * 100);

        $fillPercentage = floor(((int)$finishtest->fill_score / $totalFills) * 100);
        $mcqsPercentage = floor(((int)$finishtest->mcqs_score / $totalMcqs) * 100);
        $toalPercentage = floor(((int)$finishtest->total_score / 40) * 100);
        return view('frontend.pages.score', compact('test', 'finishtest', 'toalPercentage', 'totalFiveChoice', 'totalFills', 'totalMcqs', 'fiveChoicePercentage', 'fillPercentage', 'mcqsPercentage'));
    }
    public function correctAnswers(Request $request, $id)
    {
        $test = FinishedTest::findOrFail($id);
        $userTest = json_decode($test->test);

        $test = Test::where('id', $test->tests->id)->with('questions')->first();
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
        return view('frontend.pages.correct-answer', compact('test','data'));
    }
}
