<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class AcademicTestController extends Controller
{
    

    public function getAcademicTest(Request $request){
        $tests = Test::where('category',1)->where('type',$request->type)->get();
        
        return view('frontend.pages.academic-test',compact('tests'));
    }
}
