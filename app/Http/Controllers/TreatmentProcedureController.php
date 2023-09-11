<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\TreatmentProcedure;
use App\Models\TreatmentService;
use App\Models\ServiceProcedure;
use Carbon\Carbon;
use DataTables;
use DB;

class TreatmentProcedureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('treatmentprocedures.index');
    }

    /**
     * Fetch listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetch()
    {
        $procedures = TreatmentProcedure::select(['id', 'name', 'description']);

        return DataTables::of($procedures)
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = TreatmentService::all();
        return view('treatmentprocedures.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $procedure = TreatmentProcedure::create([
                "name" => $request->name,
                "description" => $request->description
            ]);
            
            foreach ($request->services as $key => $service) {
                ServiceProcedure::create([
                    'service_id' => $service,
                    'procedure_id' => $procedure->id
                ]);
            }

            // commit the transaction if everything is successful
            DB::commit();
            return redirect()->route('bu.treatment.service.procedure.index');
        } catch (\Exception $e) {
            // rollback the transaction if any operation fails
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to add treatment procedure!');
        }

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
