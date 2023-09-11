<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Models\Branch;
use App\Models\Patient;
use Carbon\Carbon;
use DataTables;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('patients.index');
    }

    /**
     * Display a profile of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile($patient_id)
    {
        $patient = Patient::find($patient_id);
        return view('profile.patient', compact('patient'));
    }

    /**
     * Fetch a listing of the resource.
     *
     * @return JSON
     */
    public function fetch()
    {
        $patients = Patient::with('branch')
            ->whereHas('branch', function ($query) {
                $query->where('businessunit_id', Auth::user()->id);
            })
            ->select(['id', 'first_name', 'last_name', 'contact_no', 'patient_group', 'email', 'address', 'blood_group', 'dob', 'created_at', 'branch_id' ]);

        return DataTables::of($patients)
            ->addColumn('patient.full_name', function($patient) {
                return $patient->full_name;
            })
            ->addColumn('branch.name', function($patient) {
                return $patient->branch->full_name;
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::where('businessunit_id', Auth::user()->id)->get();
        return view('patients.create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Patient::create([
            "branch_id" => $request->branch_id,
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "dob" => Carbon::createFromFormat('m/d/Y', $request->dob)->format('Y-m-d'),
            "blood_group" => $request->blood_group,
            "contact_no" => $request->contact_no,
            "email" => $request->email,
            "address" => $request->address,
            "state" => $request->state,
            "country" => $request->country,
            "pin_code" => $request->pin_code,
            "patient_group" => $request->patient_group,
            "referral" => $request->referral
        ]);

        return redirect()->route('bu.patients.index');
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
        try {
            $patient = Patiend::findOrFail($id);
            $patient->delete();

            return response()->json([
                'deleted' => true
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'deleted' => false
            ]);
        }
    }
}
