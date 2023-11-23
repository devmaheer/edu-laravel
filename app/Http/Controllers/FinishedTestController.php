<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FinishedTestController extends Controller
{
    public function startTimer(Request $request)
    {
        // Start the timer
      
        Session::put('countdownValue',$request->countdownValue);
        return response()->json(['success' => true]);
    }

    public function getCountdownValue(Request $request)
    {
        // Get the current countdown value
        $countdownValue = Session::get('countdownValue');
        return response()->json(['countdownValue' => $countdownValue]);
    }
}
