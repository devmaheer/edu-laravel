<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Appointment;
use App\Models\Chair;
use App\Traits\RelationalDataTrait;
use App\Traits\UseQuery;
use App\Http\Resources\Appointment\AppointmentCollection;
use Carbon\Carbon;
use DataTables;
use DB;

class AppointmentController extends Controller
{
    use RelationalDataTrait, UseQuery;

    private $appointmentModel;
    private $chairModel;

    public function __construct() {
        $this->appointmentModel = new Appointment();
        $this->chairModel = new Chair();
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
     * Fetch listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fetch(Request $request)
    {
        if ($request->has('calendar') && $request->input('calendar')) {
            return $this->fetchAppointmentForCalendar($request);
        } else {
            return $this->fetchAppointmentForListing($request);
        }
    }

    /**
     * Fetch appointments for listing
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fetchAppointmentForListing(Request $request)
    {
        $authUser = Auth::user();
        $appointmentsQuery = $this->query($this->appointmentModel);
        $appointments = $appointmentsQuery->with('branch', 'chair', 'employee', 'patient')
        ->when($request->has('today') && $request->input('today') === true, function($query) {
            $query->whereDate(DB::raw('DATE(date_time)'), Carbon::today());
        })
        ->when($authUser->hasRole('Business Unit'), function ($query) use($authUser) {
            $query->whereHas('branch', function($query) use($authUser){
                $query->where('businessunit_id', $authUser->id);
            });
        })
        ->when(!$authUser->hasRole('Business Unit'), function ($query) use($authUser) {
            $query->where('branch_id', $authUser->branch->id);
        })
        ->select(['id', 'branch_id', 'chair_id', 'patient_id', 'employee_id', 'status', 'date_time']);

        return DataTables::of($appointments)
            ->addColumn('branch.name', function($appointment) {
                return $appointment->branch->full_name;
            })
            ->addColumn('patient.full_name', function($appointment) {
                return $appointment->patient->full_name;
            })
            ->addColumn('patient.contact_no', function($appointment) {
                return $appointment->patient->contact_no;
            })
            ->addColumn('employee.name', function($appointment) {
                return $appointment->employee->name;
            })
            ->make(true);
    }

    /**
     * Fetch appointments for calendar
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fetchAppointmentForCalendar(Request $request)
    {
        $authUser = Auth::user();
        $appointmentQuery = $this->query($this->appointmentModel);
        $appointments = $appointmentQuery->with('branch', 'patient', 'chair', 'employee')
            ->when($authUser->hasRole('Business Unit'), function ($query) use($authUser) {
                $query->where('businessunit_id', $authUser->id);
            })
            ->when(!$authUser->hasRole('Business Unit'), function ($query) use($authUser) {
                $query->where('branch_id', $authUser->branch->id);
            })
            ->get();

        return new AppointmentCollection($appointments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = $this->getBranchesByAuth();
        return view('appointments.create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'chair_id' => [
                'required',
                Rule::exists('chairs', 'id')->where(function ($query) {
                    $query->where('occupied', false);
                })
            ],
            'patient_id' => [
                'required',
                Rule::unique('appointments')->where(function ($query) use($request) {
                    return $query->where('patient_id', $request->patient_id)
                                 ->where('date_time', $request->date);
                })
            ],
            'employee_id' => [
                'required',
                Rule::unique('appointments')->where(function ($query) use($request) {
                    return $query->where('employee_id', $request->employee_id)
                                 ->where('date_time', $request->date);
                })
            ]
        ],
        [
            'chair_id.exists' => 'The selected chair is already occupied.',
            'patient_id.unique' => 'The selected patient already has an appointment at the selected time.',
            'employee_id.unique' => 'The selected employee already has an appointment at the selected time.',
        ]);

        DB::beginTransaction();
        try {
            $authUser = Auth::user();
            $appointmentQuery = $this->query($this->appointmentModel);
            $chairQuery = $this->query($this->chairModel);

            $appointmentQuery->create([
                'partner_id' => $authUser->partner->id,
                'businessunit_id' => $authUser->hasRole('Business Unit') ? $authUser->id : $authUser->businessUnit->id,
                'branch_id' => $request->branch_id,
                'patient_id' => $request->patient_id,
                'chair_id' => $request->chair_id,
                'employee_id' => $request->employee_id,
                'date_time' => $request->date
            ]);

            $chairQuery->where('id', $request->chair_id)->update([
                'occupied' => true
            ]);
            
            DB::commit();
            return redirect()->route('home');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
