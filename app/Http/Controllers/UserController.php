<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile() {
        $user = Auth::user();

        return response()->json($user);
    }



    public function editProfile(Request $request) {
        $user = Auth::user();

        // Update user profile

        return response()->json(['message' => 'Profile updated successfully']);
    }

}
