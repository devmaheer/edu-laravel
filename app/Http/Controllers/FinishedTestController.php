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
            session()->forget('countdowntime');
            $countdowntime = Carbon::now();
            Session::put('countdowntime', $countdowntime);
        }

        return response()->json(['countdownValue' => $countdownValue]);
    }
    public function getlisteningCountdownValue(Request $request)
    {

        // Get the current countdown value
        $listeningcountdownValue = null;

        if (Session::has('listeningcountdowntime')) {
            $initialCountdownTime = 60 * 30; // 60 minutes in seconds
            $listeningcountdowntime = Carbon::parse(Session::get('listeningcountdowntime'));
            $currentTime = Carbon::now();

            $elapsedTime = $currentTime->diffInSeconds($listeningcountdowntime);
            $remainingTime = max(0, $initialCountdownTime - $elapsedTime);
            $listeningcountdownValue = $remainingTime;
        } else {
            // Set listeningcountdowntime to current time
            session()->forget('listeningcountdowntime');
            $listeningcountdowntime = Carbon::now();
            Session::put('listeningcountdowntime', $listeningcountdowntime);
        }

        return response()->json(['listeningcountdownValue' => $listeningcountdownValue]);
    }

    public function score(Request $request, $id)
    {
        if ($request->type == '2') {
            $finishtest = FinishedTest::where('id', $id)->first();
            $test = $finishtest->tests;
            
            $totalFiveChoice = Question::where('test_id', $test->id)->where('category', 3)->count();
            $totalFills = Question::where('test_id', $test->id)->where('type', 2)->where('category', 2)->count();

            $totalMcqs = Question::where('test_id', $test->id)->where('type', 2)->where('category', 1)->count();
            if($totalFiveChoice){
                $fiveChoicePercentage = floor(($finishtest->five_choice_score / ($totalFiveChoice + $totalFiveChoice)) * 100);
            }else{
                $fiveChoicePercentage= 0;
            }
           
           
            $fillPercentage =   $totalFills == 0 ? 0 : floor(((int)$finishtest->fill_score / $totalFills) * 100);
            $mcqsPercentage =  $totalMcqs == 0 ? 0 : floor(((int)$finishtest->mcqs_score / $totalMcqs) * 100);
            $toalPercentage = floor(((int)$finishtest->total_score / 40) * 100);
            $type = 2;
           
            return view('frontend.pages.score', compact('test', 'finishtest','type','toalPercentage', 'totalFiveChoice', 'totalFills', 'totalMcqs', 'fiveChoicePercentage', 'fillPercentage', 'mcqsPercentage'));
        }
        $finishtest = FinishedTest::where('id', $id)->first();
        $test = $finishtest->tests;
           
        $totalFiveChoice = Question::where('test_id', $test->id)->where('category', 3)->count();
        $totalFills = Question::where('test_id', $test->id)->where('type', 1)->where('category', 2)->count();
     
        $totalMcqs = Question::where('test_id', $test->id)->where('type', 1)->where('category', 1)->count();
       
        if($totalFiveChoice){
            $fiveChoicePercentage = floor(($finishtest->five_choice_score / ($totalFiveChoice + $totalFiveChoice)) * 100);
        }else{
            $fiveChoicePercentage= 0;
        }
 
        $fillPercentage =   $totalFills == 0 ? 0 : floor(((int)$finishtest->fill_score / $totalFills) * 100);
        $mcqsPercentage =  $totalMcqs == 0 ? 0 : floor(((int)$finishtest->mcqs_score / $totalMcqs) * 100);
        $toalPercentage = floor(((int)$finishtest->total_score / 40) * 100);
        $type = 1;
        return view('frontend.pages.score', compact('test','type', 'finishtest', 'toalPercentage', 'totalFiveChoice', 'totalFills', 'totalMcqs', 'fiveChoicePercentage', 'fillPercentage', 'mcqsPercentage'));
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
        return view('frontend.pages.correct-answer', compact('test', 'data', 'userTest'));
    }

    public function correctListeningAnswers(Request $request, $id)
    {
        $test = FinishedTest::findOrFail($id);
        $userTest = json_decode($test->test);

        $test = Test::where('id', $test->tests->id)->with('questions')->first();
        $questionsGroup = QuestionGroup::where('test_id', $test->id)->with('questions')->wherehas('questions', function ($query) {
            $query->WhereNotNull('part')->orderBy('part', 'asc');
        })->orderBy('position', 'asc')->get();


        $organizedData = [];

        // Separate questions by paragraph within their respective question groups
        $questionsGroup->each(function ($questionGroup) use (&$organizedData) {
            $partId = $questionGroup->questions->first()->part;

            // Initialize the arrays if not set
            $organizedData[$partId]['questionGroups'] ??= collect();
            $organizedData[$partId]['part'] = $partId;

            // Add the question group to the corresponding collection based on paragraph ID
            $organizedData[$partId]['questionGroups']->push([
                'questionGroup' => $questionGroup,
                'questions' => $questionGroup->questions,
            ]);
        });

        $data =  $organizedData;
        return view('frontend.pages.correct-listening-answer', compact('test', 'data', 'userTest'));
    }
}
