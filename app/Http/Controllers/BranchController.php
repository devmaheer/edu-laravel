<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\City;
use App\Models\Branch;
use App\Traits\UseQuery;

class BranchController extends Controller
{
    use UseQuery;

    /**
     * Class instances
     * 
     */
    private $branchModel;

    /**
     * Constructor
     * 
     */
    public function __construct() {
        $this->branchModel = new Branch();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branchQuery = $this->query($this->branchModel);
        $branches = $branchQuery->when(Auth::user()->hasRole('Business Unit'), function($query) {
            $query->where('businessunit_id', Auth::user()->id);
        })
        ->when(!Auth::user()->hasRole('Business Unit'), function($query) {
            $query->where('businessunit_id', Auth::user()->businessUnit->id);
        })
        ->get();

        return view('branches.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $cities = City::all();

        return view('branches.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $branchQuery = $this->query($this->branchModel);
        $branchQuery->create([
            'partner_id' => Auth::user()->partner->id,
            'businessunit_id' => Auth::user()->hasRole('Business Unit') ? Auth::user()->id : Auth::user()->businessUnit->id,
            'name_per_incorporation' => $request->name_per_incorporation,
            'name' => $request->branch_name,
            'chief' => $request->chief_name,
            'email' => $request->email_id,
            'building_name' => $request->building_name,
            'locality_or_colony' => $request->locality_or_colony,
            'city_id' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'postal_address' => $request->postal_address,
            'ssn' => $request->ssn,
            'pan' => $request->pan,
            'cin_number' => $request->cin_number,
            'contact_number' => $request->contact_number,
            'pin_code' => $request->pin_code,
            'door_number' => $request->door_number,
            'plot_number' => $request->plot_number,
            'road_number' => $request->road_number
        ]);

        return redirect()->route('bu.branches.index');
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
    public function delete($id)
    {
        //
    }
}
