<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(
    ['middleware' => 'auth:api',
    'prefix' => '/user'],
    function () {
        Route::get('index', [\App\Http\Controllers\UserController::class,'index'])->middleware('authen_admin');;


    });

        Route::post('user/create', [\App\Http\Controllers\UserController::class,'create']);






