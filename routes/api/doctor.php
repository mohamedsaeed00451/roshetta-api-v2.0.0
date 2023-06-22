<?php

use App\Http\Controllers\Api\Doctor\Clinic\ClinicController;
use App\Http\Controllers\Api\Doctor\DoctorController;
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
            Route::post('/clinic', 'addClinic');
            //*********************** Update Clinic *************************//
            Route::put('/clinic/{id}/edit', 'updateClinic');
            //*********************** Change Clinic Status *************************//
            Route::put('/clinic/{id}/status', 'statusClinic');
            //*********************** Update Clinic logo *************************//
            Route::post('/clinic/{id}/edit/logo', 'updateClinicLogo');
            //*********************** Update Clinic logo *************************//
            Route::delete('/clinic/{id}/delete/logo', 'deleteClinicLogo');


            //*********************** Update Clinic Assistant *************************//
            Route::put('/clinic/{id}/assistant/{assistant_id}/edit', 'updateClinicAssistant');
            //*********************** Get Clinic Assistant Request *************************//
            Route::get('/clinic/{id}/assistant/request', 'getClinicAssistantRequests');
            //*********************** Delete Clinic Assistant Request *************************//
            Route::delete('/clinic/{id}/assistant/delete-request/{request_id}', 'deleteClinicAssistantRequest');
            //*********************** Get Clinic Assistant *************************//
            Route::get('/clinic/{id}/assistant', 'getClinicAssistant');
            //*********************** Delete Clinic Assistant *************************//
            Route::delete('/clinic/{id}/assistant/delete', 'deleteClinicAssistant');

    });

    //*********************** Doctor  *************************//
    Route::controller(DoctorController::class)->group(function (){

        //*********************** Get Clinic  *************************//
        Route::get('/clinics', 'getClinics');
        //*********************** Get Assistants  *************************//
        Route::get('/assistants', 'getAssistants');

    });

});
