<?php

namespace App\Http\Controllers;

use App\Models\FillInBlank;
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
        dd($fiveChoice);
    }
}
