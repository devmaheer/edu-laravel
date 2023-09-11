<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Models\Branch;
use App\Models\Chair;
use App\Traits\UseQuery;
use Carbon\Carbon;
use DataTables;

class ChairController extends Controller
{
    use UseQuery;

    /**
     * Class instances 
     * 
     */
    private $chairModel;
    private $branchModel;

    /**
     * Constructor
     * 
     */
    public function __construct()
    {
        $this->chairModel = new Chair();
        $this->branchModel = new Branch();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('chairs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authUser = Auth::user();
        $branchQuery = $this->query($this->branchModel);
        $branches = $branchQuery->when($authUser->hasRole('Business Unit'), function($query) use($authUser) {
            $query->where('businessunit_id', $authUser->id);
        })
        ->when(!$authUser->hasRole('Business Unit'), function($query) use($authUser) {
            $query->where('businessunit_id', $authUser->businessUnit->id);
        })
        ->get();
        
        return view('chairs.create', compact('branches'));
    }

    /**
     * Fetch a listing of the resource.
     *
     * @return JSON
     */
    public function fetch()
    {
        $chairs = Chair::with('branch')
            ->select(['id', 'type', 'branch_id' ])
            ->get();

        return DataTables::of($chairs)
            ->addColumn('branch.name', function($chair) {
                return $chair->branch->full_name;
            })
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Chair::create([
            "branch_id" => $request->branch_id,
            "type" => $request->type
        ]);

        return redirect()->route('bu.chairs.index');
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
