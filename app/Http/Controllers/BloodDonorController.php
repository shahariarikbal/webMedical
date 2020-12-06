<?php

namespace App\Http\Controllers;

use App\models\BloodDonor;
use Illuminate\Http\Request;

class BloodDonorController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);
        $bloodDonor = new BloodDonor();
        $bloodDonor->name = $request->name;
        $bloodDonor->phone = $request->phone;
        $bloodDonor->address = $request->address;
        $bloodDonor->save();
        return response()->json('sdfgsd',200);
    }
    public function edit($id)
    {
        return response()->json();
    }
    public function list()
    {
        $bloodDonor = BloodDonor::all();
        return response()->json($bloodDonor, 200);
    }
}
