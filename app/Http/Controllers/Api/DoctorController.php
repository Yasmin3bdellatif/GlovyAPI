<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class DoctorController extends Controller
{
    public function index($id)
    {
        // Define the duration for caching in minutes
        $minutes = 60; // cache for 60 minutes

        // Retrieve user data from cache, or fetch from database if not cached
        //$user = Cache::remember('user_' . $id, $minutes, function () use ($id) {
        //    return User::findOrFail($id);
       // });

        // Return user data as JSON response
       // return response()->json($user);

    }
}


