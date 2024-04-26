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
                'token'=>$token,
                'id' => $user->id
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
        // Retrieve email and code from the request
        $email = $request->input('email');
        $code = $request->input('code');

        // Validate the request
        $request->validate([
            //'email' => 'required|email',
            'code' => 'required',
        ]);

        // Find the user by email
        $user = User::where('email', $email)->first();

        // Check if the user exists
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found with the provided email',
            ], 404);
        }

        // Check if the provided code matches the user's code
        if ($code == $user->code) {
            return response()->json([
                'status' => true,
                'message' => 'Correct verification code',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Your verification code is incorrect',
            ]);
        }
    }

    public function resetPassword(Request $request)
    {
        $email = $request->input('email');

        $user = User::where('email', $request->email)->first();
        //dd($user);
        $request->validate([
            'password' => ['required', 'confirmed', 'min:8'],
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

    public function updatePassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        // Validate the request data
        $request->validate([
            'old_password' => ['required', 'min:8'],
            'new_password' => ['required', 'confirmed', 'min:8'],
        ]);

        // Check if the old password matches the user's current password
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json(['error' => 'The old password is incorrect.'], 400);
        }

        // Update the user's password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Your password has been changed'
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json(['user' => $user], 200);


    }

    public function destroy($id)
    {
        return User::destroy($id);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        //dd($user);

        // Validate the request data, including the photo field
        $request->validate([

            'photo' => 'image|mimes:jpeg,png,jpg,gif', // Example validation for image upload
        ]);

        //dd($request->all());

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Store the photo in storage/app/public/photos directory
            $photoPath = $request->file('photo')->store('photos', 'public');
            // Update the user's photo field with the file path
            $user->photo = $photoPath;
        }

        // Update other fields if provided
        $user->update($request->all());
        //return $user;


        return response()->json(['message' => 'User profile updated successfully.', 'user' => $user]);
    }









}
