<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email|unique:employees',
                'phone' => 'required|min:11|max:11',
                'avatar' => 'required',
                'nid_no' => 'required',
                'designation' => 'required',
                'joining_date' => 'required',
                'dob' => 'required',
                'salary' => 'required',
            ]);

            $avatarName = time().'_'.'.'. $request->avatar->extension();
            $request->avatar->move(public_path('employees'), $avatarName);

            $employee = Employee::create([
                'name'          => strtolower($request->name),
                'email'         => $request->email,
                'phone'         => $request->phone,
                'nid_no'        => $request->nid_no,
                'designation'   => strtolower($request->designation),
                'joining_date'  => $request->joining_date,
                'dob'           => $request->dob,
                'salary'        => $request->salary,
                'avatar'        => $avatarName,
            ]);
            return response()->json([
                'status' => 201,
            ], 201);
        }catch (ModelNotFoundException $exception) {
            return response()->json([
                'status' => 500,
                'error'  => $exception->getMessage()
            ], 200);
        }
    }
    public function list()
    {
        return Employee::all();
    }

    public function edit($id)
    {
        $employee = Employee::find($id);
        return $employee;
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email|unique:employees,email,'.$id,
                'phone' => 'required|min:11|max:11',
                'avatar' => 'required',
                'nid_no' => 'required',
                'designation' => 'required',
                'joining_date' => 'required',
                'dob' => 'required',
                'salary' => 'required',
            ]);

            $employee = Employee::find($id);
            if ($request->hasFile('avatar')) {
                if ($employee->avatar) {
                    file_exists(public_path('/employees/').$employee->avatar);
                }else {
                    unlink(public_path('/employees/').$employee->avatar);
                }

                $avatarName = time().'_'.'.'. $request->avatar->extension();
                $request->avatar->move(public_path('employees'), $avatarName);
                $employee->avatar = $avatarName;
                $employee->save();
            }

            $employeeUpdate = $employee->update([
                'name'          => strtolower($request->name),
                'email'         => $request->email,
                'phone'         => $request->phone,
                'nid_no'        => $request->nid_no,
                'designation'   => strtolower($request->designation),
                'joining_date'  => $request->joining_date,
                'dob'           => $request->dob,
                'salary'        => $request->salary,
                'avatar'        => $avatarName,
            ]);
            return response()->json([
                'status' => 201,
            ], 201);
        }catch (ModelNotFoundException $exception) {
            return response()->json([
                'status' => 500,
                'error'  => $exception->getMessage()
            ], 200);
        }
    }

    public function view($id)
    {
        return Employee::find($id);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json();
    }
}
