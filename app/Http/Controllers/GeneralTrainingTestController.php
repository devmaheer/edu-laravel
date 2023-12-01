<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class GeneralTrainingTestController extends Controller
{
    public function getGeneralTrainingTests(Request $request){
     
        $tests = Test::where('category',2)->where('type',$request->type)->get();
        
        return view('frontend.pages.general-training',compact('tests'));
    }
}
