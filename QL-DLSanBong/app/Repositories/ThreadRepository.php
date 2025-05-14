<?php
namespace App\Repositories;

use App\Models\Thread;

class ThreadRepository
{
    protected $model;

    public function __construct(Thread $thread)
    {
        $this->model = $thread;
    }

    public function getAll($page = 1, $size = 10)
    {
        $offset = ($page - 1) * $size;

        return $this->model
            ->with(['user', 'latestMessage'])
            ->orderBy('last_send', 'desc')
            ->skip($offset)
            ->take($size)
            ->get();
    }

    public function getById($id) {
        return $this->model
            ->with(['user', 'latestMessage'])
            ->find($id);
    }

    public function getByUserId($id) {
        return $this->model
            ->where('user_id', $id)
            ->get();
    }

    public function create($data) {
        return $this->model->create($data);
    }

    public function update($id, $data) {
        $thread = $this->model->find($id);

        if (!$thread) return null;

        $thread->update($data);

        return $thread;
    }
}
