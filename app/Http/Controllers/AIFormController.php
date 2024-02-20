<?php

namespace App\Http\Controllers;

use App\Models\AIForm;
use Illuminate\Http\Request;

class AIFormController extends Controller
{
    public function submitForm(Request $request)
    {
        // Validate input data
        $validatedData = $request->validate([
            'Fo' => 'required',
            'Fio' => 'required',
            'Fhi' => 'required',
            'Jitter' => 'required',
            'Rap' => 'required',
            'Ppq' => 'required',
            'Shimmer' => 'required',
            'Dpq' => 'required',


        ]);

        // Create AI form
        $aiForm = AIForm::create($validatedData);

        return response()->json(['message' => 'AI form submitted successfully']);
    }
}
