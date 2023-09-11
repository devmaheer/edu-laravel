<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\TreatmentCategory;
use App\Models\TreatmentService;
use App\Traits\UseQuery;
use App\Helper\Helper;
use DB;

class TreatmentCategoryController extends Controller
{
    use UseQuery;
    /**
     * Class instances
     * 
     */
    private $treatmentCategoryModel;
    private $treatmentServiceModel;

    /**
     * Use constructor for initialization
     * 
     */
    public function __construct()
    {
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
        $treatmentCategoryQuery = $this->query($this->treatmentCategoryModel);
        $treatmentServiceQuery = $this->query($this->treatmentServiceModel);

        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'unique:treatment_categories,name'
            ]
        ],
        [
            'name.unique' => 'Treatment category with name "'.$request->input('quantity').'" already exists in the database.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422); // 422 is the status code for Unprocessable Entity
        }

        DB::beginTransaction();
        try {
            $treatmentCategory = $treatmentCategoryQuery->create([
                'name' => $request->name
            ]);

            if ($request->has('service_name') && $request->has('service_cost')) {
                foreach ($request->service_name as $key => $name) {
                    $treatmentServiceQuery->create([
                        'category_id' => $treatmentCategory->id,
                        'clinical_specialization_id' => $request->clinicalspecialization_id[$key],
                        'uid' => Helper::getUniqueFormatedId('TS-'),
                        'name' => $name,
                        'cost' => $request->service_cost[$key]
                    ]);
                }

                DB::commit();
                return response()
                    ->json([
                        'category' => $treatmentCategory
                    ], 200);
            }
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
     * @param  \App\Models\TreatmentCategory  $treatmentCategory
     * @return \Illuminate\Http\Response
     */
    public function show(TreatmentCategory $treatmentCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TreatmentCategory  $treatmentCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(TreatmentCategory $treatmentCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TreatmentCategory  $treatmentCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TreatmentCategory $treatmentCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TreatmentCategory  $treatmentCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TreatmentCategory $treatmentCategory)
    {
        //
    }
}
