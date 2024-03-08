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
        Route::get('/', [UserController::class, 'profile']);
        Route::put('/', [UserController::class, 'editProfile']);
    });
#endregion


//doctors info
Route::get('/doctors', [DoctorController::class, 'index']);

//ai form
Route::post('/submit-ai-form', [AIFormController::class, 'submitForm']);

//home
Route::middleware('auth:sanctum')->get('/', [GlovyController::class, 'glovy']);

