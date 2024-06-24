<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use App\Models\User;

class QRCodeController extends Controller
{
    protected $database;

    public function __construct()
    {
        $firebase = (new Factory)->withServiceAccount(config('firebase.credentials.file'));
        $this->database = $firebase->createDatabase();
    }

    public function scanQr(Request $request)
    {
        $userId = $request->input('user_id', 1); // قيمة افتراضية للاختبار

        // استرجاع بيانات المستخدم من قاعدة البيانات
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // استرجاع بيانات من Firebase
        $dataRef = $this->database->getReference('data/' . $userId);
        $firebaseData = $dataRef->getValue();

        return view('user_profile', [
            'username' => $user->username,
            'birthdate' => $user->birthdate,
            'phoneNumber' => $user->phone_number,
            'chartData' => $firebaseData
        ]);
    }
}
