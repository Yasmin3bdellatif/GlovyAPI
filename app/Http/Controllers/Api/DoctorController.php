<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class DoctorController extends Controller
{
   // public function index($id)
   // {
        // Define the duration for caching in minutes
        //$minutes = 60; // cache for 60 minutes

        // Retrieve user data from cache, or fetch from database if not cached
        //$user = Cache::remember('user_' . $id, $minutes, function () use ($id) {
        //    return User::findOrFail($id);
       // });

        // Return user data as JSON response
       // return response()->json($user);



    //}


    public function cacheData(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'photo' => 'required|image',
        ]);

        $data = [
            'name' => $validatedData['name'],
            'number' => $validatedData['number'],
            'address' => $validatedData['address'],
        ];

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos');
            $data['photo'] = $photoPath;
        }

        Cache::put('user_data', $data);

        return response()->json(['message' => 'Data stored in cache successfully!', 'data' => $data]);
    }


}


