<?php

use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Http\Request;
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

    'prefix' => 'assistant',
    'middleware' => ['assistant', 'check.language', 'check.api.password', 'jwt.verify:assistant']

], function () {


});
