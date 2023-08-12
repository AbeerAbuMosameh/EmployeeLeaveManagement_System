<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateEmployeeLeaveRequest;
use App\Models\EmployeesLeaveRequests;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class EmployeesRequestsController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:employees-leaves-request-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:employees-leaves-request-edit', ['only' => ['edit', 'update']]);
    }

    /**
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees_requests = EmployeesLeaveRequests::with('employee')->get();
        return view('Admin.employees_requests.index', compact('employees_requests'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeLeaveRequest $request, $id)
    {

        if (Gate::denies('employees-leaves-request-edit', LeaveType::class)) {
            abort(404);
        }

        $employeesLeaveRequests = EmployeesLeaveRequests::findOrFail($id);
        if($employeesLeaveRequests->status == 'pending'){
            $employeesLeaveRequests->update($request->all());
            toastr()->success('Employees Leave Requests Status changed Successfully');
            return redirect()->route('employee_requests.index');
        }else{
            toastr()->info('Employees Leave Requests Approved/Denied Previously');
            return redirect()->route('employee_requests.index');
        }
    }

}
