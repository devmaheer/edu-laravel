<?php

namespace App\Http\Controllers;

use App\Models\FillInBlank;
use App\Models\FinishedTest;
use App\Models\Option;
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
            $query->where('type',1)->WhereNotNull('paragraph')->orderBy('paragraph', 'asc');
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
        session()->forget('countdowntime');
        session()->forget('listeningcountdowntime');
        $test = Test::findOrFail($request->test_id);
        $mcqsResult = [];
        if ($request->mcqs) {
            foreach ($request->mcqs as $key => $option) {

                $ans = Option::where('id', $option)->first();
                if ($ans->is_correct == 0) {
                    $mcqsResult[$key] = false;
                } else {
                    $mcqsResult[$key] = true;
                }
            }
        }
        $fillResult = [];

        if ($request->fill) {
            foreach ($request->fill as $key => $fill) {

                $fills = FillInBlank::where('question_id', $key)->first();
                if (isset($fill[0])) {
                    $fillResult[$key]['first'] = false;

                    if (strtolower($fills->ans_first_1) == strtolower($fill[0])) {
                        $fillResult[$key]['first'] = true;
                    }
                    if (strtolower($fills->ans_first_2) == strtolower($fill[0])) {
                        $fillResult[$key]['first'] = true;
                    }
                    if (strtolower($fills->ans_first_3) == strtolower($fill[0])) {
                        $fillResult[$key]['first'] = true;
                    }
                }
                if (isset($fill[1])) {
                    $fillResult[$key]['sec'] = false;
                    if (strtolower($fills->ans_sec_1) == strtolower($fill[1])) {
                        $fillResult[$key]['sec'] = true;
                    }
                    if (strtolower($fills->ans_sec_2) == strtolower($fill[1])) {
                        $fillResult[$key]['sec'] = true;
                    }
                    if (strtolower($fills->ans_sec_3) == strtolower($fill[1])) {
                        $fillResult[$key]['sec'] = true;
                    }
                }
                if (isset($fill[2])) {
                    $fillResult[$key]['third'] = false;
                    if (strtolower($fills->ans_third_1) == strtolower($fill[2])) {
                        $fillResult[$key]['third'] = true;
                    }
                    if (strtolower($fills->ans_third_2) == strtolower($fill[2])) {
                        $fillResult[$key]['third'] = true;
                    }
                    if (strtolower($fills->ans_third_3) == strtolower($fill[2])) {
                        $fillResult[$key]['third'] = true;
                    }
                }
            }
        }
        $fiveChoice = [];

        if ($request->fivechoice) {
            foreach ($request->fivechoice as $key => $option) {
                if (isset($option[0])) {
                    $ans = Option::where('id', $option[0])->first();
                    if ($ans->is_correct == 0) {
                        $fiveChoice[$key][$option[0]] = false;
                    } else {
                        $fiveChoice[$key][$option[0]] = true;
                    }
                }
                if (isset($option[1])) {
                    $ans = Option::where('id', $option[1])->first();
                    if ($ans->is_correct == 0) {
                        $fiveChoice[$key][$option[1]] = false;
                    } else {
                        $fiveChoice[$key][$option[1]] = true;
                    }
                }
            }
        }

        $fiveScoreResult = $this->fiveChoiceScore($fiveChoice);
        $fillResult = $this->fillScore($fillResult);
        $mcqsResult =  $this->mcqsScore($mcqsResult);
        $test =   FinishedTest::create([
            'test_id' => $request->test_id,
            'fill_score' => $fillResult,
            'mcqs_score' => $mcqsResult,
            'five_choice_score' => $fiveScoreResult,
            'total_score' => $fillResult + $mcqsResult + $fiveScoreResult,
            'test' => json_encode($request->all()),
            'user_id' => isset(auth()->user()->id) ? auth()->user()->id : null,
        ]);


        return redirect()->route('test.score', $test->id);
    }
    public function fiveChoiceScore($data)
    {
        $score = 0;
        // Iterate through the outer array
        foreach ($data as $questionId => $innerArray) {
            // Check if any value in the inner array is true
            if (in_array(true, $innerArray, true)) {
                // Increment the score
                $score++;
            }
        }
        return $score;
    }
    public function mcqsScore($data)
    {
        // Initialize score variable
        $score = 0;
        // Iterate through the array
        foreach ($data as $questionId => $value) {
            // Check if the value is true
            if ($value === true) {
                // Increment the score
                $score++;
            }
        }
        return $score;
    }
    public function fillScore($data)
    {
       
        // Initialize a variable to store the count
        $count = 0;

        // Iterate through the outer array
        foreach ($data as $innerArray) {
            // Check if any value in the inner array is false
            if (in_array(false, $innerArray, true)) {
                // If false is found, do not increment count
                continue;
            }

            // If all values are true, increment count
            $count++;
        }
        return $count;
    }
    public function show(Request $request,$id){
    $test = Test::findOrFail($id);

    return view('frontend.pages.reading-test.partials.show',compact('test'));
    }
}
