<?php

use App\Http\Controllers\AIFormController;
use App\Http\Controllers\Api\DoctorController;
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
//Route::post('/register', [\App\Http\Controllers\AuthController::class,'register']);
//Route::post('/login', [\App\Http\Controllers\AuthController::class,'login']);

//profile
//Route::middleware('auth:sanctum')->get('/profile', [UserController::class, 'profile']);
//edit profile
//Route::middleware('auth:sanctum')->put('/profile', [UserController::class, 'editProfile']);





#region users
//localhost/api/users/login
Route::prefix('users')
    ->name('users.')
    ->controller(AuthController::class)
    ->group(function (){
    Route::post('register','register')->name('register');
    Route::post('login','login')->name('login');
});

#endregion


#region profile
Route::prefix('profile')
    ->name('profile')
    ->middleware(['profile', 'profile'])
    ->group(function () {
        Route::get('/profile', [UserController::class, 'show']);
        Route::put('/profile', [UserController::class, 'update']);
        Route::delete('/profile', [UserController::class, 'destroy']);


    });
#endregion


#region doctors
// routes/api.php
Route::prefix('doctors')->group(function () {
    Route::get('/', [DoctorController::class, 'index']);
    Route::post('/', [DoctorController::class, 'store']);
    Route::get('/{id}', [DoctorController::class, 'show']);
    Route::put('/{id}', [DoctorController::class, 'update']);
    Route::delete('/{id}', [DoctorController::class, 'destroy']);
});
#endregion


//ai form
Route::post('/submit-ai-form', [AIFormController::class, 'submitForm']);

//home

