<?php

namespace App\Http\Controllers;

use App\Http\Requests\AIFormRequest;
use App\Models\AIForm;
use Illuminate\Http\Request;

class AIFormController extends Controller
{
    public function submitForm(AIFormRequest $request)
    {

        // Create AI form
        $aiForm = AIForm::create($request->validated());

        return response()->json(['message' => 'AI form submitted successfully']);
    }
}
