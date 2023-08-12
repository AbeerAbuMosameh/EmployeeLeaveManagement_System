<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeesLeaveRequests;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class EmployeesLeaveRequestsController extends Controller
{


    function __construct()
    {
        $this->middleware('permission:leaves-request-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:leaves-request-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:leaves-request-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:leaves-request-delete', ['only' => ['destroy']]);
    }




    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::denies('leaves-request-list', EmployeesLeaveRequests::class)) {
            abort(404);
        }
        $leave_requests = EmployeesLeaveRequests::forEmployee(auth()->user()->email)->get();
        return view('Employee.leave_requests.index', compact('leave_requests'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $leave_types = LeaveType::all();

        return view('Employee.leave_requests.create' , [
                'leave_request' => new EmployeesLeaveRequests(),
                'leave_types' => $leave_types
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Gate::denies('leaves-request-create', EmployeesLeaveRequests::class)) {
            abort(404);
        }

        $id = Employee::where('email',auth()->user()->email)->pluck('id');

        $request->merge([
            'employee_id' => $id[0],
        ]);

        $validator = Validator::make($request->all(), [
            'leave_type' => 'required|string|exists:leave_types,name',
            'duration' => 'required|integer|min:1',
            'duration_unit' => 'required|in:hours,days,weeks,months',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'leave_reason' => 'nullable|string',
            'employee_id' => 'required|exists:employees,id',
        ]);

        if ($validator->fails()) {
            toastr()->error($validator->errors()->first());
            return redirect()->route('leaves_request.index');
        }

        EmployeesLeaveRequests::create($request->all());
        toastr()->success('Leave Request  Created Successfully');
        return redirect()->route('leaves_request.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeesLeaveRequests $employeesLeaveRequests)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $leave_types = LeaveType::all();
        $leave_request = EmployeesLeaveRequests::findOrFail($id);
        return view('Employee.leave_requests.edit',compact('leave_request','leave_types'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (Gate::denies('leaves-request-edit', EmployeesLeaveRequests::class)) {
            abort(404);
        }

        $validator = Validator::make($request->all(), [
            'leave_type' => 'required|string|exists:leave_types,name',
            'duration' => 'required|integer|min:1',
            'duration_unit' => 'required|in:hours,days,weeks,months',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'leave_reason' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            toastr()->error($validator->errors()->first());
            return redirect()->route('leaves_request.index');
        }

        $leaveRequest = EmployeesLeaveRequests::find($id);

        if ($leaveRequest && $leaveRequest->status === 'pending') {
            $leaveRequest->update($request->all());
            toastr()->success('Leave Request Update Successfully');
            return redirect()->route('leaves_request.index');
        } else {
            toastr()->error('Leave Request Can\'t Change');

            return redirect()->route('leaves_request.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        if (Gate::denies('leaves-request-delete', EmployeesLeaveRequests::class)) {
            abort(404);
        }
        $employeesLeaveRequests = EmployeesLeaveRequests::findOrFail($id);
        if($employeesLeaveRequests->staus == 'pending'){
            $employeesLeaveRequests->delete();
        return response()->json(['message' => 'Leave Type deleted.']);
        }
    }
}
