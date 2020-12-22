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
        return response()->json('Saved',200);
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);
        $bloodDonor = BloodDonor::find($request->id);
        $bloodDonor->name = $request->name;
        $bloodDonor->phone = $request->phone;
        $bloodDonor->address = $request->address;
        $bloodDonor->save();
        return response()->json('Updated',200);
    }
    public function edit($id)
    {
        return response()->json();
    }
    public function bloodDonorList()
    {
        $bloodDonor = BloodDonor::orderBy('id','desc')->get();
        return response()->json($bloodDonor, 200);
    }
    public function view($id)
    {
        $bloodDonor = BloodDonor::find($id);
        return response()->json($bloodDonor, 200);
    }
    public function destroy($id)
    {
        BloodDonor::find($id)->delete();
        return response()->json('Soft Delete', 200);
    }
    public function trashList()
    {
        $bloodDonor = BloodDonor::onlyTrashed()->get();
        return response()->json($bloodDonor, 200);
    }
    public function permanentDestroy($id)
    {
        BloodDonor::onlyTrashed()->forceDelete($id);
        return response()->json('Deleted', 200);
    }
    public function restore($id)
    {
        BloodDonor::onlyTrashed()->find($id)->restore();
        return response()->json('Restored', 200);
    }
}
