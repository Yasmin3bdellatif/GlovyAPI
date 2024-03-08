<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return response()->json($user);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function destroy()
    {
        $user = Auth::user();
        $user->delete();
        return response()->json(null, 204);
    }



}
