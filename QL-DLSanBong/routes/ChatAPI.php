<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

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
    'prefix' => '/threads'
    ], function () {
        Route::get('/', [ChatController::class, 'getThreads']);        // Lấy tất cả thread trò chuyện
        Route::get('{id}', action: [ChatController::class, 'getMessages']); // Lấy tất cả message theo thread id
    });

Route::group([
    'middleware' => 'auth:api',
    'prefix' => '/messages'
    ], function () {
        Route::get('/', [ChatController::class, 'getThread']); // Lấy thread bao gồm tin nhắn của người dùng với admin
        Route::post('/send-message', [ChatController::class, 'sendMessage']);  // Gửi tin nhắn cho admin
        Route::post('/writing', action: [ChatController::class, 'writingMessage']); // Đang viết tin nhắn
        Route::post('/read', action: [ChatController::class, 'readMessage']);
    });



