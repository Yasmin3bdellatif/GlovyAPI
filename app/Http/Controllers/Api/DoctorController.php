<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class DoctorController extends Controller
{
    public function cacheData(DoctorRequest $request)
    {
        // Validation is performed automatically by DoctorRequest class
        $validatedData = $request->validated();

        $data = [
            'name' => $validatedData['name'],
            'number' => $validatedData['number'],
            'address' => $validatedData['address'],
        ];

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos');
            $data['photo'] = $photoPath;
        }

        // Retrieve existing data from cache, or initialize an empty array if not exists
        $existingData = Cache::get('user_data', []);

        // Debugging line: Log existing data before adding new data
        Log::info('Existing Data: ', $existingData);

        // Add new data to existing data
        $existingData[] = $data;

        // Debugging line: Log updated data
        Log::info('Updated Data: ', $existingData);

        // Store the updated data back to cache
        Cache::put('user_data', $existingData);

        return response()->json(['message' => 'Data stored in cache successfully!', 'data' => $data]);
    }

    public function show()
    {
        // Retrieve cached data
        $userData = Cache::get('user_data', []);

        // Debugging line: Log retrieved data
        Log::info('Retrieved Data: ', $userData);

        if (!empty($userData)) {
            return response()->json(['message' => 'Cached data retrieved successfully!', 'data' => $userData]);
        } else {
            return response()->json(['message' => 'No cached data found.'], 404);
        }
    }
}
