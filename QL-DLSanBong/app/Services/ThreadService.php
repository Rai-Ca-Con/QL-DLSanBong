<?php

namespace App\Services;

use App\Repositories\MessageRepository;
use App\Repositories\ReceiptRepository;
use App\Repositories\ThreadRepository;
use App\Exceptions\AppException;
use App\Enums\ErrorCode;
use Illuminate\Support\Facades\Log;
class ThreadService
{
    const ADMIN_ID = 'admin_000';
    protected $threadRepository;
    protected $messageRepository;

    public function __construct(ThreadRepository $receiptRepository, MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
        $this->threadRepository = $receiptRepository;
    }

    public function getAll($page = 1, $size = 10) {
        return $this->threadRepository->getAll($page, $size);
    }

    public function getById($id, $page = 1, $size = 10) {
        $thread = $this->threadRepository->getById($id);
        if (!$thread)
            throw new AppException(ErrorCode::THREAD_NON_EXISTED_OR_NON_PERMISSION);
        $thread = $this->settingThread($thread, ThreadService::ADMIN_ID);
        $thread->messages = $this->messageRepository->getAll($id, $page, $size);
        return $thread;
    }

    public function getByUserId($user_id, $page = 1, $size = 10) {
        $threads = $this->threadRepository->getByUserId($user_id);
        if (!$threads || sizeof($threads) === 0)
            throw new AppException(ErrorCode::THREAD_NON_EXISTED_OR_NON_PERMISSION);
        $thread = $this->settingThread($threads[0], $user_id);
        $thread->messages = $this->messageRepository->getAll($thread->id, $page, $size);
        return $thread;
    }

    function settingThread($thread, $user_id) {
        $this->readAllMessage($user_id, $thread);
        if ($thread->last_sender_id !== $user_id) {
            $thread->readed = true;
        }
        $index = 0;
        $now = now();
        while (sizeof($thread->messages) > $index && $thread->messages[$index]->sender_id === $user_id)
            $index++;
        while (sizeof($thread->messages) > $index && $thread->messages[$index]->sender_id !== $user_id) {
            $thread->messages[$index]->readed = true;
            $thread->messages[$index]->time_read = $now;
            $index++;
        }
        return $thread;
    }

    public function createThread($user_id) {
        return $this->threadRepository->create(["user_id" => $user_id]);
    }

    private function readAllMessage($user_id, $thread) {
        $this->messageRepository->readAll($thread->id, $user_id);
        if ($thread->last_sender_id !== $user_id) {
            $thread->readed = true;
            $thread->save();
        }
    }
}
