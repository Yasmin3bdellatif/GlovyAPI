<?php

use App\Http\Controllers\AIFormController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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
    ->controller(UserController::class)
    ->group(function (){
    Route::post('register','register')->name('register');
    Route::post('login','login')->name('login');
    Route::get('generateOTP','generateOTP')->name('generateOTP');
    Route::get('verifyOTP','verifyOTP')->name('verifyOTP');
    Route::get('resetPassword','resetPassword')->name('resetPassword');
    Route::post('logout','logout')->middleware('auth:sanctum')->name('logout');

    });
#endregion





#region doctors
// routes/api.php
//Route::prefix('doctors')->group(function () {
//    Route::get('/', [DoctorController::class, 'index']);
//    Route::post('/', [DoctorController::class, 'store']);
//    Route::get('/{id}', [DoctorController::class, 'show']);
//    Route::put('/{id}', [DoctorController::class, 'update']);
//    Route::delete('/{id}', [DoctorController::class, 'destroy']);
//});
Route::post('/doctors', [DoctorController::class, 'cacheData']);

//Route::get('/api/users/{id}', [UserController::class,'index']);

#endregion


#regionAI
//ai form
Route::post('/submit-ai-form', [AIFormController::class, 'submitForm']);
#endregion


#regiontest
/*Route::get('/test' ,function () {
    return 'something';
});*/
#endregion
