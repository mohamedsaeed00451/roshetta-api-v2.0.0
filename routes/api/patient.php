<?php

use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Http\Request;
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

    'prefix' => 'patient',
    'middleware' => ['patient', 'check.language', 'check.api.password', 'jwt.verify:patient']

], function () {



});
