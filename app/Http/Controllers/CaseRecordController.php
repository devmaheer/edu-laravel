<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Traits\UseQuery;
use App\Models\CaseRecord;
use App\Models\TreatmentCategory;
use App\Models\ComplaintType;
use App\Models\Tooth;
use App\Models\ChiefComplaint;
use App\Models\ClinicalFinding;
use App\Models\Investigation;
use App\Models\Note;
use App\Models\Patient;
use App\Models\User;
use App\Models\TreatmentPlan;
use App\Models\ClinicalSpecialization;
use Carbon\Carbon;
use DataTables;
use DB;

class CaseRecordController extends Controller
{
    use UseQuery;

    private $complaintTypeModel;
    private $toothModel;
    private $treatmentCategoryModel;
    private $chiefComplaintModel;
    private $clinicalFindingModel;
    private $investigationModel;
    private $caseRecordModel;
    private $patientModel;
    private $userModel;
    private $noteModel;
    private $treatmentPlanModel;
    private $clinicalSpecializationModel;

    /**
     * Constructor
     * 
     */
    public function __construct()
    {
        $this->complaintTypeModel = new ComplaintType();
        $this->toothModel = new Tooth();
        $this->treatmentCategoryModel = new TreatmentCategory();
        $this->chiefComplaintModel = new ChiefComplaint();
        $this->clinicalFindingModel = new ClinicalFinding();
        $this->investigationModel = new Investigation();
        $this->caseRecordModel = new CaseRecord();
        $this->patientModel = new Patient();
        $this->userModel = new User();
        $this->noteModel = new Note();
        $this->treatmentPlanModel = new TreatmentPlan();
        $this->clinicalSpecializationModel = new ClinicalSpecialization();
    }

    /**
     * Page to display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cases.index');
    }

    /**
     * Fetch a listing of the resource.
     * 
     */
    public function fetch()
    {
        $caseRecordQuery = $this->query($this->caseRecordModel);
        $cases = $caseRecordQuery->with(
            'patient',
            'branch:id,name',
            'dutyDoctor:id,name'
        )->get();

        return DataTables::of($cases)
            ->addColumn('patient.uid', function($case) {
                return $case->patient->uid;
            })
            ->addColumn('patient.group', function($case) {
                return $case->patient->patient_group;
            })
            ->addColumn('patient.name', function($case) {
                return $case->patient->full_name;
            })
            ->addColumn('branch.name', function($case) {
                return $case->branch->full_name;
            })
            ->addColumn('dutyDoctor.name', function($case) {
                return $case->dutyDoctor->name;
            })
            ->addColumn('createdAt', function($case) {
                return Carbon::parse($case->created_at)->format('Y-m-d');
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
        $authUser = Auth::user();
        $patientQuery = $this->query($this->patientModel);
        $complaintTypeQuery = $this->query($this->complaintTypeModel);
        $toothQuery = $this->query($this->toothModel);
        $treatmentCategoryQuery = $this->query($this->treatmentCategoryModel);
        $clinicalSpecializationQuery = $this->query($this->clinicalSpecializationModel);

        $patients = $patientQuery->with('branch:id')
        ->when($authUser->hasRole('Business Unit'), function ($query) use($authUser) {
            $query->where('businessunit_id', $authUser->id);
        })
        ->when(!$authUser->hasRole('Business Unit'), function ($query) use($authUser) {
            $query->where('branch_id', $authUser->branch->id);
        })
        ->get();

        $complaintTypes = $complaintTypeQuery->get();
        $teeth = $toothQuery->get();
        $treatmentCategories = $treatmentCategoryQuery->get();
        $clinicalSpecializations = $clinicalSpecializationQuery->get();

        return view('cases.create', compact('complaintTypes', 'teeth', 'treatmentCategories', 'patients', 'clinicalSpecializations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $authUser = Auth::user();
        $caseRecordQuery = $this->query($this->caseRecordModel);
        $chiefComplaintQuery = $this->query($this->chiefComplaintModel);
        $clinicalFindingQuery = $this->query($this->clinicalFindingModel);
        $investigationQuery = $this->query($this->investigationModel);
        $treatmentPlanQuery = $this->query($this->treatmentPlanModel);
        $noteQuery = $this->query($this->noteModel);

        DB::beginTransaction();
        try {
            $case = $caseRecordQuery->create([
                'partner_id' => $authUser->partner->id,
                'businessunit_id' => $authUser->hasRole('Business Unit') ? $authUser->id : $authUser->businessUnit->id,
                'duty_doctor_id' => $request->duty_doctor_id,
                'branch_id' => $request->branch_id,
                'patient_id' => $request->patient_id,
            ]);

            foreach ($request->type_id_complaint as $key => $value) {
                $chiefComplaintQuery->create([
                    'case_id' => $case->id,
                    'type_id' => $value,
                    'tooth_id' => $request->tooth_id_complaint[$key]
                ]);
            }
            
            foreach ($request->type_id_finding as $key => $value) {
                $clinicalFindingQuery->create([
                    'case_id' => $case->id,
                    'type_id' => $value,
                    'tooth_id' => $request->tooth_id_finding[$key]
                ]);
            }

            $investigationQuery->create([
                'case_id' => $case->id,
                'blood_pressure' => $request->blood_pressure,
                'oxygen' => $request->oxygen,
                'blood_sugar' => $request->blood_sugar
            ]);

            foreach ($request->treatmentcategory_id as $key => $treatmentcategory_id) {
                $treatmentPlanQuery->create([
                    'case_id' => $case->id,
                    'treatmentcategory_id' => $treatmentcategory_id,
                    'treatmentservice_id' => $request->treatmentservice_id[$key],
                    'quantity' => $request->quantity[$key],
                    'discount' => $request->discount[$key]
                ]);
            }

            $filteredNotes = array_filter($request->case_notes, function ($note) {
                return $note !== null;
            });

            if (!empty($filteredNotes)) {
                foreach ($filteredNotes as $key => $note) {
                    $noteQuery->create([
                        'notable_id' => $case->id,
                        'notable_type' => get_class($this->caseRecordModel),
                        'body' => $note
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('bu.case.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(CaseRecord $caseRecord, $caseId = null)
    {
        $caseRecordQuery = $this->query($this->caseRecordModel);
        $case = $caseRecordQuery->with(
            'patient',
            'branch',
            'dutyDoctor',
            'complaints.type',
            'complaints.tooth',
            'findings.type',
            'findings.tooth',
            'investigation',
            'treatmentPlans.category',
            'treatmentPlans.service',
            'attachments',
            'notes'
        )
        ->find($caseId);

        return view('cases.view', compact('case'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($caseId)
    {
        $authUser = Auth::user();
        $patientQuery = $this->query($this->patientModel);
        $complaintTypeQuery = $this->query($this->complaintTypeModel);
        $toothQuery = $this->query($this->toothModel);
        $treatmentCategoryQuery = $this->query($this->treatmentCategoryModel);
        $caseRecordQuery = $this->query($this->caseRecordModel);
        $dentistQuery = $this->query($this->userModel);

        $case = $caseRecordQuery->with(
            'patient',
            'branch',
            'dutyDoctor',
            'complaints.type',
            'complaints.tooth',
            'findings.type',
            'findings.tooth',
            'investigation',
            'treatmentPlans.category.services',
            'treatmentPlans.service',
            'attachments',
            'notes'
        )->find($caseId);

        $patients = $patientQuery->with('branch:id')
        ->when($authUser->hasRole('Business Unit'), function ($query) use($authUser) {
            $query->where('businessunit_id', $authUser->id);
        })
        ->when(!$authUser->hasRole('Business Unit'), function ($query) use($authUser) {
            $query->where('branch_id', $authUser->branch->id);
        })
        ->get();

        $complaintTypes = $complaintTypeQuery->get();
        $teeth = $toothQuery->get();
        $treatmentCategories = $treatmentCategoryQuery->get();
        $dentists = $dentistQuery->where('branch_id', $case->branch_id)->get();

        return view('cases.edit', compact('case', 'dentists', 'complaintTypes', 'teeth', 'treatmentCategories', 'patients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CaseRecord  $caseRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CaseRecord $caseRecord)
    {
        $chiefComplaintQuery = $this->query($this->chiefComplaintModel);
        $clinicalFindingQuery = $this->query($this->clinicalFindingModel);
        $treatmentPlanQuery = $this->query($this->treatmentPlanModel);
        $noteQuery = $this->query($this->noteModel);

        DB::beginTransaction();
        try {
            $caseRecord->update([
                'duty_doctor_id' => $request->duty_doctor_id
            ]);

            foreach ($request->type_id_complaint as $key => $value) {
                if (!is_null($request->complaint_id[$key])) {
                    $chiefComplaintQuery->where('id', $request->complaint_id[$key])
                        ->update([
                            'type_id' => $value,
                            'tooth_id' => $request->tooth_id_complaint[$key]
                        ]);
                } else {
                    $chiefComplaintQuery->create([
                        'case_id' => $caseRecord->id,
                        'type_id' => $value,
                        'tooth_id' => $request->tooth_id_complaint[$key]
                    ]);
                }
            }

            foreach ($request->type_id_finding as $key => $value) {
                if (!is_null($request->finding_id[$key])) {
                    $clinicalFindingQuery->where('id', $request->finding_id[$key])
                        ->update([
                            'type_id' => $value,
                            'tooth_id' => $request->tooth_id_finding[$key]
                        ]);
                } else {
                    $clinicalFindingQuery->create([
                        'case_id' => $caseRecord->id,
                        'type_id' => $value,
                        'tooth_id' => $request->tooth_id_finding[$key]
                    ]);
                }
            }

            foreach ($request->treatmentcategory_id as $key => $treatmentcategory_id) {
                if (!is_null($request->treatmentplan_id[$key])) {
                    $treatmentPlanQuery->where('id', $request->treatmentplan_id[$key])
                        ->update([
                            'treatmentcategory_id' => $treatmentcategory_id,
                            'treatmentservice_id' => $request->treatmentservice_id[$key],
                            'quantity' => $request->quantity[$key],
                            'discount' => $request->discount[$key]
                        ]);
                } else {
                    $treatmentPlanQuery->create([
                        'case_id' => $caseRecord->id,
                        'treatmentcategory_id' => $treatmentcategory_id,
                        'treatmentservice_id' => $request->treatmentservice_id[$key],
                        'quantity' => $request->quantity[$key],
                        'discount' => $request->discount[$key]
                    ]);
                }
            }

            foreach ($request->case_notes as $key => $note) {
                if(!is_null($request->note_id[$key]) && !is_null($note)) {
                    $noteQuery->where('id', $request->note_id[$key])
                        ->update([
                            'body' => $note
                        ]);
                } else {
                    if (!is_null($note)) {
                        $noteQuery->create([
                            'notable_id' => $caseRecord->id,
                            'notable_type' => get_class($this->caseRecordModel),
                            'body' => $note
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('bu.case.show', $caseRecord->id);
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CaseRecord  $caseRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(CaseRecord $caseRecord)
    {
        //
    }
}
