<?php

use App\Http\Controllers\AIFormController;
use App\Http\Controllers\GlovyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')
//    ->get('/user', function (Request $request) {
//    return $request->user();
//});



//registration and login
Route::post('/register', [\App\Http\Controllers\AuthController::class,'register']);
Route::post('/login', [\App\Http\Controllers\AuthController::class,'login']);

//profile
Route::middleware('auth:sanctum')->get('/profile', [UserController::class, 'profile']);
//edit profile
Route::middleware('auth:sanctum')->put('/profile', [UserController::class, 'editProfile']);

//doctors info
Route::get('/doctors', [\App\Http\Controllers\DoctorController::class, 'index']);

//exercise
Route::get('/exercises', [\App\Http\Controllers\ExerciseController::class, 'index']);

//ai form
Route::post('/submit-ai-form', [AIFormController::class, 'submitForm']);

//home
Route::middleware('auth:sanctum')->get('/', [GlovyController::class, 'glovy']);

