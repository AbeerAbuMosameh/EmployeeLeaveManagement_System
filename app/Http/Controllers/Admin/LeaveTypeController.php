<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LeaveTypeController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:leaves-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:leaves-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:leaves-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:leaves-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leave_types = LeaveType::all();
        return view('Admin.leave_types.index', compact('leave_types'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Gate::denies('leaves-create', LeaveType::class)) {
            abort(404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:20',
            'description' => 'nullable|min:3|max:250',
        ]);

        if ($validator->fails()) {
            toastr()->error($validator->errors()->first());
            return redirect()->route('leaves_type.index');
        }

        LeaveType::create($request->all());
        toastr()->success('Leave Type Created Successfully');
        return redirect()->route('leaves_type.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(LeaveType $leaveType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaveType $leaveType)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (Gate::denies('leaves-edit', LeaveType::class)) {
            abort(404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:20',
            'description' => 'nullable|min:3|max:250',
        ]);

        if ($validator->fails()) {
            toastr()->error($validator->errors()->first());
            return redirect()->route('leaves_type.index');
        }
        LeaveType::query()->find($id)->update($request->all());
        toastr()->success('Leave Type Updated Successfully');
        return redirect()->route('leaves_type.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeaveType $leaveType)
    {
        //
    }
}
