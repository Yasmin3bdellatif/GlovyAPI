<?php

use App\Http\Controllers\AIFormController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




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
    Route::post('resetPassword','resetPassword')->name('resetPassword');
    Route::post('logout','logout')->middleware('auth:sanctum')->name('logout');
    Route::put('update/{id}','update')->name('update');
    Route::get('show/{id}',  'show')->name('show');
    Route::delete('destroy/{id}',  'destroy')->name('destroy');




    });
#endregion

#region doctors
// routes/api.php

Route::post('/doctors', [DoctorController::class, 'cacheData']);

//Route::get('/api/users/{id}', [UserController::class,'index']);

#endregion

#regionAI
//ai form
Route::post('/submit-ai-form', [AIFormController::class, 'submitForm']);
#endregion


