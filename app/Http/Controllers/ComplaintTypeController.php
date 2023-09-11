<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ComplaintType;
use App\Traits\UseQuery;
use DB;

class ComplaintTypeController extends Controller
{
    use UseQuery;

    /**
     * Class instances
     * 
     */
    private $complaintTypeModel;

    /**
     * Constructor
     * 
     */
    public function __construct()
    {
        $this->complaintTypeModel = new ComplaintType();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $complaintTypeQuery = $this->query($this->complaintTypeModel);

        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'unique:complaint_types,name'
            ]
        ],
        [
            'name.unique' => 'Complaint type with name "'.$request->input('name').'" already exists in the database.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422); // 422 is the status code for Unprocessable Entity
        }

        DB::beginTransaction();
        try {
            $complaintType = $complaintTypeQuery->create([
                'name' => $request->name,
                'description' => $request->description
            ]);

            DB::commit();
            return response()->json([
                'type' => $complaintType
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()
                ->json([
                    'exception' => 'Unexpected error occurred.'
                ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ComplaintType  $complaintType
     * @return \Illuminate\Http\Response
     */
    public function show(ComplaintType $complaintType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ComplaintType  $complaintType
     * @return \Illuminate\Http\Response
     */
    public function edit(ComplaintType $complaintType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ComplaintType  $complaintType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComplaintType $complaintType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComplaintType  $complaintType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComplaintType $complaintType)
    {
        //
    }
}
