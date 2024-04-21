<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\sendCode;

class OtpService
{
    public function generateCode(User $user)
    {
        $user->timestamps = false;
        $user->code = rand(100000, 999999);
        $user->expired_at = now()->addMinute(15);
        $user->save();
    }


    public function generateAndSendOTP($email)
    {
        $user = User::where('email', $email)->first();

        //mdd($user);
        if (!$user) {
            return [
                'success' => false,
                'message' => 'There is no account with this email',
            ];
        }

        try {
            $this->generateCode($user); // Pass the user to generate the code
            $user->notify(new SendCode()); // Send OTP notification

            return [
                'success' => true,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to generate OTP. Please try again later.',
            ];
        }
    }
}

