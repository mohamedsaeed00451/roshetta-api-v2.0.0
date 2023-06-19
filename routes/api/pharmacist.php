<?php

use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Pharmacist API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register pharmacist API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::group([

    'prefix' => 'pharmacist',
    'middleware' => ['pharmacist', 'check.language', 'check.api.password', 'jwt.verify:pharmacist']

], function () {


});
