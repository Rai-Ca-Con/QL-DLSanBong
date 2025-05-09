<?php

namespace App\Services;

use App\Events\MessageReaded;
use App\Http\Resources\ThreadResource;
use Illuminate\Support\Facades\DB;
use App\Models\Message;
use App\Repositories\MessageRepository;
use App\Repositories\ThreadRepository;
use App\Exceptions\AppException;
use App\Enums\ErrorCode;
use Illuminate\Support\Facades\Log;

class MessageService
{
    const ADMIN_ID = 'admin_000';
    protected $messageRepository;
    protected $threadRepository;
    protected $threadService;
    public function __construct(ThreadRepository $receiptRepository, MessageRepository $messageRepository, ThreadService $threadService)
    {
        $this->threadRepository = $receiptRepository;
        $this->messageRepository = $messageRepository;
        $this->threadService = $threadService;
    }

    public function getAll($user_id, $thread_id, $page = 1, $size = 10) {
        $thread = $this->threadRepository->getById($thread_id);
        if (!$thread || ($thread['user_id'] !== $user_id && $user_id !== MessageService::ADMIN_ID))
            throw new AppException(ErrorCode::THREAD_NON_EXISTED_OR_NON_PERMISSION);
        return $this->messageRepository->getAll($thread_id, $page, $size);
    }

    public function sendMessage($user_id, $thread_id, $content) {
        return DB::transaction(function () use ($thread_id, $user_id, $content) {
            //Log::info('', ['thread_id' => $thread_id]);
            $thread = $this->threadRepository->getById($thread_id);

            if ($thread == null) {
                if ($user_id === MessageService::ADMIN_ID)
                    throw new AppException(ErrorCode::THREAD_NON_EXISTED_OR_NON_PERMISSION);
                $thread = $this->threadService->createThread($user_id);
            } else if ($thread['user_id'] !== $user_id && $user_id !== MessageService::ADMIN_ID) {
                throw new AppException(ErrorCode::THREAD_NON_EXISTED_OR_NON_PERMISSION);
            }

            $this->readAllMessage($user_id, $thread);

            $newMessage = $this->messageRepository->create([
                'sender_id' => $user_id,
                'receiver_id' => $user_id === MessageService::ADMIN_ID ? $thread['user_id'] : MessageService::ADMIN_ID,
                'content' => $content,
                'thread_id' => $thread['id'],
                'time_send' => now(),
            ]);

            $this->threadRepository->update($thread['id'], [
                'last_send' => $newMessage->time_send,
                'last_sender_id' => $user_id,
                'readed' => false
            ]);

            return $newMessage;
        });
    }

    public function readAllMessage($user_id, $thread) {
        return DB::transaction(function () use ($user_id, $thread) {
            if (is_string($thread))
                $thread = $this->threadRepository->getById($thread);
            $this->messageRepository->readAll($thread->id, $user_id);
            if ($thread->last_sender_id !== $user_id && !$thread->readed) {
                $thread->readed = true;
                $thread->save();
                event(new MessageReaded($thread->last_sender_id, new ThreadResource($thread)));
            }
        });
    }

    function checkUserHasThread($thread, $user_id): bool {
        return !$thread || $thread['user_id'] !== $user_id || $user_id !== MessageService::ADMIN_ID;
    }
}
