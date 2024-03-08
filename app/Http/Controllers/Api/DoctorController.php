<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;

class DoctorController extends Controller
{
    //all doctors
    public function index()
    {
        $doctors = Doctor::all();
        return response()->json($doctors);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'image' => 'string'
        ]);

        $doctor = Doctor::create($request->all());
        return response()->json($doctor, 201);
    }

    public function show($id)
    {
        $doctor = Doctor::find($id);
        if (!$doctor) {
            return response()->json(['message' => 'Does not exist'], 404);
        }
        return response()->json($doctor);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string'
        ]);

        $doctor = Doctor::find($id);
        if (!$doctor) {
            return response()->json(['message' => 'Does not exist'], 404);
        }

        $doctor->update($request->all());
        return response()->json($doctor, 200);
    }

    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        if (!$doctor) {
            return response()->json(['message' => 'Does not exist'], 404);
        }

        $doctor->delete();
        return response()->json(['message' => 'Done'], 200);
    }
}
