<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['auth:api'],
    'prefix' => '/bookings'
], function () {
    Route::post('/', [BookingController::class, 'store']); // Đặt sân
    Route::delete('{id}', [BookingController::class, 'cancel']); // Huỷ đặt sân
    Route::get('user', [BookingController::class, 'userBookings']); // Lịch sử đặt sân
});

Route::get('/vnpay/callback', [BookingController::class, 'handleBookingPayment']);
//Route::match(['get', 'post'], '/vnpay/callback', [BookingController::class, 'handleBookingPayment']);

