<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Branch;
use App\Traits\UseQuery;
use Carbon\Carbon;
use DataTables;
use DB;

class EmploymentController extends Controller
{
    use UseQuery;

    /**
     * 
     * Class instances
     */
    private $employmentModel;

    /**
     * 
     * Constructor method
     */
    public function __construct() {
        $this->employmentModel = new User();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employments.index');
    }

    /**
     * Fetch listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetch()
    {
        $authUser = Auth::user();
        $employmentQuery = $this->query($this->employmentModel);
        $employments = $employmentQuery->with('branch', 'details', 'roles')
            ->whereHas('branch', function($query) use($authUser) {
                $query->when($authUser->hasRole('Business Unit'), function($query) use($authUser) {
                    $query->where('businessunit_id', $authUser->id);
                })
                ->when(!$authUser->hasRole('Business Unit'), function($query) use($authUser) {
                    $query->where('businessunit_id', $authUser->businessUnit->id);
                });
            })
            ->whereHas('roles', function($query) {
                $query->whereNotIn('name', ['Admin', 'Partner', 'Business Unit']);
            })
            ->select(['id', 'name', 'email', 'branch_id'])
            ->get();

        return DataTables::of($employments)
            ->addColumn('branch.name', function($employment) {
                return $employment->branch->full_name;
            })
            ->addColumn('role.name', function($employment) {
                return $employment->roles[0]->name;
            })
            ->addColumn('details.contactNumber', function($employment) {
                return $employment->details->contact_number;
            })->addColumn('details.startDate', function($employment) {
                return $employment->details->start_date;
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
        $roles = Role::whereNotIn('name', ['Admin', 'Partner', 'Business Unit'])->get();

        return view('employments.create', compact('branches', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $authUser = Auth::user();
            DB::beginTransaction();
            $user = User::create([
                'partner_id' => $authUser->partner->id,
                'businessunit_id' => $authUser->hasRole('Business Unit') ? $authUser->id : $authUser->businessUnit->id,
                'branch_id' => $request->branch_id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make(env('SYSTEM_ADMIN_PASSWORD'))
            ]);

            Role::find($request->role)->users()->attach($user);

            UserDetail::create([
                'user_id' => $user->id,
                'contact_number' => $request->contact_number,
                'start_date' => Carbon::parse($request->start_date)->format('Y-m-d')
            ]);

            DB::commit();
            return redirect()->route('bu.employment.index');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return redirect()->route('bu.employment.index');
        }

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
