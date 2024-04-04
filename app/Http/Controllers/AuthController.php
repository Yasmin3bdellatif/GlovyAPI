<?php

namespace App\Http\Controllers;

use  App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;


class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        // Validate the request
        $validatedData = $request->validated();


        // Create new user
            $user = User::create([
                'name' => $validatedData['name'],
                'username' => $validatedData['username'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'birthdate' => $validatedData['birthdate'],
                'phoneNumber' => $validatedData['phoneNumber'],
            ]);



        return response()->json(['message' => 'You registered successfully']);
    }



    public function login(LoginRequest $request) {
        // Extract email or username from the request
        $emailOrUsername = $request->input('email') ?: $request->input('username');

        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $emailOrUsername, 'password' => $request->input('password')]) ||
            Auth::attempt(['username' => $emailOrUsername, 'password' => $request->input('password')])) {

            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            $user->generateCode();

            return response()->json(['message' =>'You logged in']);


        } else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }

    public function logout(){
        $user = Auth::guard('user')->user();

        if ($user) {
            $accessToken = $user->token();

            if ($accessToken) {
                DB::table('oauth_refresh_tokens')
                    ->where('access_token_id', $accessToken->id)
                    ->update(['revoked' => true]);

                    $accessToken->revoke();
            }
            return response([
                'status' => true,
                'message' => 'Logged out successfully',
            ]);
        }
    }

    public function generateOTP(Request $request)
    {
        $user = Auth::user(); // Get the currently authenticated user

        if (!$user) {
            return response([
                'message' => 'There is no account with this email',
            ]);
        }

        $user->generateCode(); // Generate OTP code
        $user->notify(new OTP()); // Send OTP notification
        return response([
            'OTP-Code' => $user->code,
        ]);
    }








}
