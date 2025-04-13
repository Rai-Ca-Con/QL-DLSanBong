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

Route::group(['prefix' => '/field'],
function () {
    Route::get('index', [\App\Http\Controllers\FieldController::class,'index']);
    Route::post('create', [\App\Http\Controllers\FieldController::class,'create']);
});

