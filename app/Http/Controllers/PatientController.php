<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function store(Request $request)
    {
        try{
            $request->validate([
                'name'        => 'required|string|max:255',
                'phone'       => 'required|unique:patients',
                'email'       => 'required|email|unique:patients',
                'father_name' => 'required|string|max:255',
                'nid'         => 'required',
                'address'     => 'required|string|max:255',
                'cabin'       => 'required|string|max:255',
                'bed'         => 'required|string|max:255',
                'diseas'      => 'required',
                'sex'         => 'required'
            ]);
            $patient              = new Patient();
            $patient->name        = $request->name;
            $patient->phone       = $request->phone;
            $patient->email       = $request->email;
            $patient->father_name = $request->father_name;
            $patient->nid         = $request->nid;
            $patient->address     = $request->address;
            $patient->cabin       = $request->cabin;
            $patient->bed         = $request->bed;
            $patient->disease      = $request->diseas;
            if($request->sex === 'Male'){
                $patient->sex         = 0;
            }else{
                $patient->sex         = 1;
            };
            $patient->save();
            return response()->json($patient,200);

        }catch (ModelNotFoundException $exception) {
            return response()->json([
                'status' => 500,
                'error'  => $exception->getMessage()
            ], 200);
        }
    }
    public function patients()
    {
        return response()->json(Patient::all(),200);
    }
    public function destroy($id)
    {
        return response()->json(Patient::destroy($id),200);
    }
    public function edit($id)
    {
        $patient = Patient::find($id);
        return response()->json($patient,200);
    }
    public function update(Request $request)
    {
        $patient = Patient::find($request->id);
        $patient->name        = $request->name;
        $patient->phone       = $request->phone;
        $patient->email       = $request->email;
        $patient->father_name = $request->father_name;
        $patient->nid         = $request->nid;
        $patient->address     = $request->address;
        $patient->cabin       = $request->cabin;
        $patient->bed         = $request->bed;
        $patient->disease     = $request->diseas;
        if($request->sex === 'Male'){
            $patient->sex         = 1;
        }else{
            $patient->sex         = 0;
        };
        $patient->save();
        return response()->json($patient,200);
    }
    public function details($id)
    {
        $patient = Patient::find($id);
        return response()->json($patient,200);
    }
}