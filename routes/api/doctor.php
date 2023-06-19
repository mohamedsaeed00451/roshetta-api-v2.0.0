<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Doctor\Clinic\ClinicController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Doctor API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register doctor API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::group([

    'middleware' => ['check.language', 'check.api.password', 'jwt.verify:doctor','check.account.status']

], function () {

    //*********************** Clinic *************************//
    Route::controller(ClinicController::class)->group(function (){

        //*********************** Create Clinic *************************//
        Route::post('/clinic/create', 'addClinic');
        //*********************** Update Clinic *************************//
        Route::post('/clinic/update', 'updateClinic');
        //*********************** Change Clinic Status *************************//
        Route::post('/clinic/status', 'statusClinic');
        //*********************** Update Clinic logo *************************//
        Route::post('/clinic/logo/update', 'updateClinicLogo');
        //*********************** Update Clinic logo *************************//
        Route::post('/clinic/logo/delete', 'deleteClinicLogo');


        //*********************** Update Clinic Assistant *************************//
        Route::post('/clinic/assistant/update', 'updateClinicAssistant');
        //*********************** Get Clinic Assistant Request *************************//
        Route::post('/clinic/assistant/request', 'getClinicAssistantRequests');
        //*********************** Delete Clinic Assistant Request *************************//
        Route::post('/clinic/assistant/delete-request', 'deleteClinicAssistantRequest');
        //*********************** Get Clinic Assistant *************************//
        Route::post('/clinic/assistant', 'getClinicAssistant');
        //*********************** Delete Clinic Assistant *************************//
        Route::post('/clinic/assistant/delete', 'deleteClinicAssistant');



    });

});
