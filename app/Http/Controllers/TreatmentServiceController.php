<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TreatmentService;
use App\Models\ClinicalSpecialization;
use App\Models\TreatmentCategory;
use App\Traits\UseQuery;
use Carbon\Carbon;
use DataTables;

class TreatmentServiceController extends Controller
{
    use UseQuery;

    private $clinicalSpecializationModel;
    private $treatmentCategoryModel;
    private $treatmentServiceModel;

    /**
     * Constructor
     * 
     */
    public function __construct()
    {
        $this->clinicalSpecializationModel = new ClinicalSpecialization();
        $this->treatmentCategoryModel = new TreatmentCategory();
        $this->treatmentServiceModel = new TreatmentService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('treatmentservices.index');
    }

    /**
     * Fetch listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetch()
    {
        $services = TreatmentService::with('category')
            ->select(['id', 'name', 'description', 'category_id' ])
            ->get();

        return DataTables::of($services)
            ->addColumn('category.name', function($service) {
                return $service->category->name;
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
        $treatmentCategoryQuery = $this->query($this->treatmentCategoryModel);
        $clinicalSpecializationQuery = $this->query($this->clinicalSpecializationModel);

        $categories = $treatmentCategoryQuery->get();
        $clinicalSpecializations = $clinicalSpecializationQuery->get();
        return view('treatmentservices.create', compact('categories', 'clinicalSpecializations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        TreatmentService::create([
            'category_id' => $request->category_id,
            'clinical_specialization_id' => $request->clinical_specialization_id,
            'name' => $request->name,
            'cost' => $request->cost,
            'description' => $request->description
        ]);

        return redirect()->route('bu.treatment.service.index');
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
