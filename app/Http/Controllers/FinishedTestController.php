<?php

namespace App\Http\Controllers;

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
}
