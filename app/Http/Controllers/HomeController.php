<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Branch;
use App\Models\Question;
use App\Models\QuestionGroup;
use App\Models\Test;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function frontend()
    {

        return view('frontend.index');
    }
    public function index()
    {
        $questCount = Question::count();
        $test = Test::get();
        $userCount = User::count();
        $questionGroupCount = QuestionGroup::count();

        if (Auth::user()->hasRole('Admin')) {
            $partners = User::whereHas('roles', function ($query) {
                $query->where('name', 'Partner');
            })->get();

            return view('admin.index', compact('partners', 'userCount', 'questionGroupCount', 'questCount', 'test'));
        } 
        if (Auth::user()->hasRole('User')) {
            $questCount = Question::count();
            $test = Test::get();
    
            return view('user.index', compact('questCount', 'test'));
        } 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userDashboard(Request $request)
    {

        $questCount = Question::count();
        $test = Test::get();

        return view('user.index', compact('questCount', 'test'));
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
