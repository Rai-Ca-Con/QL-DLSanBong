<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ThreadResource extends JsonResource
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
            'user_id' => $this->user_id,
            'last_send' => $this->last_send,
            'last_sender_id' => $this->last_sender_id,
            'readed' => $this->readed,
            'messages' => MessageResource::collection($this->whenLoaded('messages')),
            'user' => new UserResource($this->whenLoaded('user')),
            'latest_message' => new MessageResource($this->whenLoaded("latestMessage")),
            'messages_count' => $this->messages_count
        ];
    }
}
