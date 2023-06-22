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
    'middleware' => ['check.language', 'check.api.password']

], function () {

    //*********************** Register *************************//
    Route::post('/register', 'register');
    //*********************** Send Email Verification Code *************************//
    Route::post('/send-email-otp', 'sendEmailOtpVerification');
    //*********************** Send Phone Verification Code *************************//
    Route::post('/send-phone-otp', 'sendPhoneOtpVerification');
    //*********************** Login *************************//
    Route::post('/login/{type}', 'login')->whereIn('type', getTypesForRoute());
    //*********************** Reset Password *************************//
    Route::put('/password/reset/{type}', 'resetPassword')->whereIn('type', getTypesForRoute());

    //*********************** Specialists *************************//
    Route::get('/specialists', 'getSpecialists');
    //*********************** Genders *************************//
    Route::get('/genders', 'getGenders');
    //*********************** Governorates *************************//
    Route::get('/governorates', 'getGovernorates');


    Route::middleware(['jwt.verify', 'check.account.status'])->group(function () {

        //*********************** Profile *************************//
        Route::get('/profile/{type}', 'profile')->whereIn('type', getTypesForRoute());
        //*********************** Logout *************************//
        Route::post('/logout/{type}', 'logout')->whereIn('type', getTypesForRoute());
        //*********************** Refresh Token *************************//
        Route::post('/refresh-token/{type}', 'refresh')->whereIn('type', getTypesForRoute());
        //*********************** Update Image *************************//
        Route::post('/image/edit/{type}', 'updateProfileImage')->whereIn('type', getTypesForRoute());
        //*********************** Delete Image *************************//
        Route::delete('/image/delete/{type}', 'deleteProfileImage')->whereIn('type', getTypesForRoute());
        //*********************** Update Password *************************//
        Route::put('/password/edit/{type}', 'updatePassword')->whereIn('type', getTypesForRoute());
        //*********************** Update Profile *************************//
        Route::put('/profile/edit/{type}', 'updateProfile')->whereIn('type', getTypesForRoute());
        //*********************** Update Profile *************************//
        Route::get('/video/{type}', 'getVideo')->whereIn('type', getTypesForRoute());

    });


});
