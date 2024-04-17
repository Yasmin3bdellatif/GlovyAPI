<?php

namespace App\Http\Controllers;

use  App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Notifications\sendCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use App\Services\OtpService;



class UserController extends Controller
{
    public function register(RegisterRequest $request)
    {
        // Validate the request
        $validatedData = $request->validated();


        // Create new user
        $user = Auth::create([
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'birthdate' => $validatedData['birthdate'],
            'phoneNumber' => $validatedData['phoneNumber'],
        ]);


        return response()->json(['message' => 'You registered successfully']);
    }

    public function login(LoginRequest $request)
    {
        // Extract email or username from the request
        $emailOrUsername = $request->input('email') ?: $request->input('username');

        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $emailOrUsername, 'password' => $request->input('password')]) ||
            Auth::attempt(['username' => $emailOrUsername, 'password' => $request->input('password')])) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;


            return response()->json(['message' => 'You logged in',
                'token'=>$token
                ])
                ;


        } else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response([
            'message'=>'You logged out'
        ]);
    }

    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    public function generateOTP(Request $request)
    {
        $email = $request->input('email');

        $result = $this->otpService->generateAndSendOTP($email);

        if ($result['success']) {
            return response()->json([
                'message' => 'OTP sent successfully',
            ]);
        } else {
            return response()->json([
                'message' => $result['message'],
            ], 500);
        }

    }



    public function verifyOTP(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $request->validate([
            'code' => 'required',
        ]);

        if ($request->code == $user->code) {
            return response(
                [
                    'status' => true,
                    'message' => 'Correct verification code',
                ]);
        } else {
            return response([
                'status' => false,
                'message' => 'Your verification code is incorrect',
            ]);
        }
    }

    public function resetPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        $request->validate([
            'password' => ['required', 'confirmed', 'min:8', Password::defaults()],
        ]);

        $user->update([
            'password' => Hash::make($request->password),
            'code' => null, // Clear the verification code after successful reset
        ]);
        return response([
            'status' => true,
            'message' => 'Your password has been changed'
        ]);
    }


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
