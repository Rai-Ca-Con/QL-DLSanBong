<?php

use App\Http\Controllers\StatisticsController;
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

Route::group([
    'middleware' => ['auth:api', 'authen_admin:api'],
    'prefix' => '/statistics'
], function () {
    Route::get('/revenue-by-field', [StatisticsController::class, 'revenueByField']); // doanh thu tat ca san
    Route::get('/revenue-until-date', [StatisticsController::class, 'statsUntilDate']); // thong ke so luot dat san
    Route::get('/top-users', [StatisticsController::class, 'mostActiveUsers']); // cac nguoi dung dat nhieu lan
    Route::get('/revenue-report', [StatisticsController::class, 'revenueReport']); //thong ke cac hoa don cua tung san theo khoang thoi gian hoac khung gio
});
