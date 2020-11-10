<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name'          => 'required|string|max:255',
                'email'         => 'required|email|unique:doctors',
                'phone'         => 'required|unique:doctors',
                'nid_no'        => 'required',
                'visiting_day'  => 'required|string|max:255',
                'visiting_time' => 'required|string|max:255',
                'visiting_fee'  => 'required',
                'specialist'    => 'required|string|max:255',
                'doctor_degree' => 'required|string|max:255',
                'avatar'        => 'required',
            ]);
            $avatarName = time().'_'.'.'. $request->avatar->extension();
            $request->avatar->move(public_path('avatar'), $avatarName);

            $doctor = Doctor::create([
                'name'          => $request->name,
                'email'         => $request->email,
                'phone'         => $request->phone,
                'nid_no'        => $request->nid_no,
                'visiting_day'  => str_replace(' ', '-', $request->visiting_day),
                'visiting_time' => $request->visiting_time,
                'visiting_fee'  => $request->visiting_fee,
                'specialist'    => $request->specialist,
                'doctor_degree' => str_replace(' ', ',', $request->doctor_degree),
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

    public function doctors()
    {
        return Doctor::get();
    }

    public function details($id)
    {
        $doctor = Doctor::find($id);
        return response()->json($doctor);
    }
}
