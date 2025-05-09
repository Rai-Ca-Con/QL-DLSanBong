<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'sender_id' => $this->sender_id,
            'receiver_id' => $this->receiver_id,
            'time_send' => $this->time_send,
            'content' => $this->content,
            'readed' => $this->readed,
            'time_read' => $this->time_read,
            'thread_id' => $this->thread_id
        ];
    }
}
