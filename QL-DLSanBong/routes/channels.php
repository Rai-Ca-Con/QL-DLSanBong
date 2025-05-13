<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;
/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chatting.{userId}', function ($ignored, $userId) {
    // Lấy model User thực sự từ guard 'api'
    $user = auth('api')->user();       // hoặc Auth::guard('api')->user()

    // Debug: kiểm tra xem $user là object hay null
    Log::info('Broadcast auth check', [
        'user_instance' => is_object($user) ? get_class($user) : null,
        'user'          => $user,
        'param_userId'  => $userId,
    ]);

    // Nếu $user hợp lệ và ID khớp, trả về true
    return $user && ((string)$user->id === (string)$userId);
});
