<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\sendCode;

class OtpService
{

    public function generateAndSendOTP($email)
    {


        $user = User::where('email', $email)->first();

        //dd($user);
        if (!$user) {
            return [
                'success' => false,
                'message' => 'There is no account with this email',
            ];
        }

        try {
            $user->generateCode(); // Generate OTP code
            $user->notify(new SendCode()); // Send OTP notification

            return [
                'success' => true,
            ];
        } catch (\Exception $e) {
            // Handle any exceptions
            return [
                'success' => false,
                'message' => 'Failed to generate OTP. Please try again later.',
            ];
        }
    }
}

