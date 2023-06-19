<?php

use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Auth API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([

    'controller' => AuthController::class,
    'middleware' => ['check.language','check.api.password']

], function () {

    //*********************** Register *************************//
    Route::post('/register','register');
    //*********************** Send Email Verification Code *************************//
    Route::post('/send-email-otp','sendEmailOtpVerification');
    //*********************** Send Phone Verification Code *************************//
    Route::post('/send-phone-otp','sendPhoneOtpVerification');
    //*********************** Login *************************//
    Route::post('/login','login');
    //*********************** Reset Password *************************//
    Route::post('/reset-password','resetPassword');

    //*********************** Specialists *************************//
    Route::get('/specialists','getSpecialists');
    //*********************** Genders *************************//
    Route::get('/genders','getGenders');
    //*********************** Governorates *************************//
    Route::get('/governorates','getGovernorates');


    Route::middleware(['jwt.verify','check.account.status'])->group(function (){

        //*********************** Profile *************************//
        Route::post('/profile', 'profile');
        //*********************** Logout *************************//
        Route::post('/logout', 'logout');
        //*********************** Refresh Token *************************//
        Route::post('/refresh-token', 'refresh');
        //*********************** Update Image *************************//
        Route::post('/update-image', 'updateProfileImage');
        //*********************** Delete Image *************************//
        Route::post('/delete-image', 'deleteProfileImage');
        //*********************** Update Password *************************//
        Route::post('/update-password', 'updatePassword');
        //*********************** Update Profile *************************//
        Route::post('/update-profile', 'updateProfile');
        //*********************** Update Profile *************************//
        Route::post('/video', 'getVideo');

    });


});
