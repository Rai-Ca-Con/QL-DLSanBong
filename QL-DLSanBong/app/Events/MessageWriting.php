<?php
namespace App\Events;

use App\Http\Resources\CommentResource;
use App\Http\Resources\MessageResource;
use App\Http\Resources\ThreadResource;
use App\Responses\APIResponse;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MessageWriting implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets;
    private $threadResource;
    private $user_id;

    public function __construct($user_id, ThreadResource $messageResource)
    {
        //
        $this->user_id = $user_id;
        $this->threadResource = $messageResource;
    }

    // tra ve 1 channel public co ten comments
    public function broadcastOn()
    {
        return new PrivateChannel('chatting.' . $this->user_id);
    }

    //Cau hinh ten su kien ngan gon khi lang nghe phia FE thay vi App\Events\CommentCreated
    public function broadcastAs()
    {
        return 'MessageWriting';
    }

    // customize kieu du lieu tra ve
    public function broadcastWith()
    {
        return[
            'message' => "Thành công!",
            'content' => $this->threadResource->resolve()
        ] ;

    }
}
