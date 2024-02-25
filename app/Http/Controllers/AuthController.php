<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(RegisterRequest $request) {
        // Create new user
        $user = User::create([
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'birthdate' => $request->input('birthdate'),
        ]);

        return response()->json(['message' => 'User registered successfully']);
    }


    public function login(LoginRequest $request) {


        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $request->input('username_or_email'),
            'password' => $request->input('password')])) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json(['token' => $token]);
        } else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }


}
