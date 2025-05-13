<?php
namespace App\Repositories;

use App\Models\Message;

class MessageRepository
{
    protected $model;

    public function __construct(Message $message)
    {
        $this->model = $message;
    }

    public function getAll($thread_id, $page = 1, $size = 10)
    {
        $offset = ($page - 1) * $size;

        return $this->model
            ->with(['images'])
            ->where('thread_id', $thread_id)
            ->orderBy('time_send', 'desc')
            ->skip($offset)
            ->take($size)
            ->get();
    }

    public function getById($id) {
        return $this->model
            ->with(['sender', 'thread'])
            ->find($id);
    }

    public function create($data) {
        return $this->model->create($data);
    }

    public function update($id, $data) {
        $message = $this->model->find($id);

        if (!$message) return null;

        $message->update($data);

        return $message;
    }

    public function readAll($thread_id, $user_id) {
        $now = now();

        $this->model
            ->where('thread_id', $thread_id)
            ->where('receiver_id', $user_id)
            ->where('readed', false)
            ->update([
                'readed' => true,
                'time_read' => $now
            ]);

        return $now;
    }
}
