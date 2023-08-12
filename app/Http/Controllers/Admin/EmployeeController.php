<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\imageTrait;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{

    use imageTrait;

    function __construct()
    {
        $this->middleware('permission:employees-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:employees-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:employees-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:employees-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        return view('Admin.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.employees.create' , [
                'employee' => new Employee()
                ]
        );

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        try {
            DB::beginTransaction();
            $Data = $request->except('image');

            if ($request->hasFile('image')) {
                $coverImage = $request->file('image');
                $coverImagePath = $this->storeImage($coverImage);
                $Data['image'] = $coverImagePath;
            }
            Employee::create($Data);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('123456'),
                'role' => 'employee',
            ]);

            $employeeRole = Role::where('name', 'employee')->first();
            $user->assignRole($employeeRole);

            DB::commit();
            toastr()->success('Employee Created Successfully');
            return redirect()->route('employees.index');
        }catch (\Exception){
            DB::rollBack();
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $employee = Employee::findOrFail($employee->id);
        return view('admin.employees.edit',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        try {
            DB::beginTransaction();
            $Data = $request->except('image');
            if ($request->hasFile('image')) {
                $coverImage = $request->file('image');
                $coverImagePath = $this->storeImage($coverImage);
                if ($employee->image) {
                    $this->deleteImage($employee->image);
                }
                $Data['image'] = $coverImagePath;
            }

            $employee->update($Data);

            DB::commit();
            toastr()->success('Employee Updated Successfully');
            return redirect()->route('employees.index');
        }catch (\Exception){
            DB::rollBack();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        if (Gate::denies('employees-delete', Employee::class)) {
            abort(404);
        }

        Employee::findOrFail($employee->id)->delete();
        return response()->json(['message' => 'Employee deleted.']);
    }
}
