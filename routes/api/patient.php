<?php

use App\Http\Controllers\Api\Patient\Appointment\AppointmentController;
use App\Http\Controllers\Api\Patient\PatientController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Patient API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register patient API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/




Route::group([

    'middleware' => ['patient', 'check.language', 'check.api.password', 'jwt.verify:patient','check.account.status']

], function () {

    //*********************** Appointments  *************************//
    Route::controller(AppointmentController::class)->group(function (){

        //*********************** Add Appointment  *************************//
        Route::post('/appointment', 'store');
        //*********************** Get Appointment  *************************//
        Route::get('/appointments', 'index');
        //*********************** Update Appointment  *************************//
        Route::put('/appointment/{id}/edit', 'update');
        //*********************** Update Appointment  *************************//
        Route::delete('/appointment/{id}/delete', 'destroy');

    });

    //*********************** Patient  *************************//
    Route::controller(PatientController::class)->group(function (){

        //*********************** Get Clinics  *************************//
        Route::get('/clinics', 'getClinics');


    });

});
