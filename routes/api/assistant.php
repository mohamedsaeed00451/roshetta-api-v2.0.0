<?php

use App\Http\Controllers\Api\Assistant\AssistantController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Assistant API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register assistant API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::group([

    'middleware' => ['check.language', 'check.api.password', 'jwt.verify:assistant','check.account.status']

], function () {

    //*********************** Assistant  *************************//
    Route::controller(AssistantController::class)->group(function (){

        //*********************** Get Clinic Requests *************************//
        Route::get('/clinics/requests', 'getAssistantClinicRequests');
        //*********************** Accept Clinic Request  *************************//
        Route::put('/clinic/accept-request/{request_id}', 'acceptClinicRequest');
        //*********************** Get Clinics  *************************//
        Route::get('/clinics', 'getAssistantClinics');
        //*********************** Get Clinic Appointments  *************************//
        Route::get('/clinic/{id}/appointments', 'getClinicAppointments');
        //*********************** Change Clinic Appointment Status  *************************//
        Route::put('/clinic/{id}/appointment/{appointment_id}', 'changeAppointmentStatus');

    });


});
