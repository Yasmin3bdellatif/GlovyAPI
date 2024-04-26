<?php

namespace App\Http\Controllers;

use App\Http\Requests\AIFormRequest;
use App\Models\AIForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AIFormController extends Controller
{
    public function submitForm(AIFormRequest $request)
    {
        //dd(Auth::user());
        // Create AI form
      // $aiForm = AIForm::create($request->validated());
        $aiForm= Auth::user()->AIForm()->create($request->validated());
        return response()->json(['message' => 'AI form submitted successfully']);
    }
    public function destroy(AIForm $form)
    {
        $form->delete();
        return response()->json(['message'=>'Form deleted']);
    }
}
