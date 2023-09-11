<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClinicalSpecialization;
use Carbon\Carbon;
use DataTables;

class ClinicalSpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clinicalspecializations.index');
    }

    /**
     * Fetch listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetch()
    {
        $specializations = ClinicalSpecialization::select(['id', 'name', 'description'])
            ->get();

        return DataTables::of($specializations)
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        ClinicalSpecialization::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('bu.clinical.specialization.index');
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
