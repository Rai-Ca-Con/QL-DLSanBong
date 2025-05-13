<?php

namespace App\Http\Controllers;
use App\Events\MessageCreated;
use App\Events\MessageWriting;
use App\Http\Requests\MessageRequest\ReadMessageRequest;
use App\Http\Requests\MessageRequest\SendMessageRequest;
use App\Http\Resources\MessageResource;
use App\Http\Resources\ThreadResource;
use App\Responses\APIResponse;
use App\Services\MessageService;
use App\Services\ThreadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    protected $messageService;
    protected $threadService;

    public function __construct(MessageService $messageService, ThreadService $threadService)
    {
        $this->messageService = $messageService;
        $this->threadService = $threadService;
    }
    public function getThreads(Request $request) {
        $page = $request->input('page', 1);
        $size = $request->input('size', 10);
        $threads = $this->threadService->getAll($page, $size);
        //Log::info("", ["threads" => $threads]);
        return APIResponse::success(
            ThreadResource::collection($threads)
        );
    }
    public function getMessages(Request $request, $id) {
        $page = $request->input('page', 1);
        $size = $request->input('size', 10);
        return APIResponse::success(
            new ThreadResource($this->threadService->getById($id, $page, $size))
        );
    }
    public function getThread(Request $request) {
        $page = $request->input('page', 1);
        $size = $request->input('size', 10);
        $user_id = auth()->id();
        return APIResponse::success(
            new ThreadResource($this->threadService->getByUserId($user_id, $page, $size))
        );
    }

    public function readMessage(ReadMessageRequest $request) {
        $request->validated();
        $user_id = auth()->id();
        $this->messageService->readAllMessage($user_id, $request->thread_id);
        return APIResponse::success();
    }

    public function writingMessage(ReadMessageRequest $request) {
        $request->validated();
        $thread = $this->threadService->getById($request->thread_id);
        if ($thread) {
            event(new MessageWriting(
                auth()->user()->is_admin ? $thread->user_id : MessageService::ADMIN_ID,
                new ThreadResource($thread)
            ));
        }
        return APIResponse::success();
    }

    public function sendMessage(SendMessageRequest $request)
    {
        $data = $request->validated();
        $user_id = auth()->id();
        $message = $this->messageService->sendMessage($user_id, $data, $request);
        $resource = new MessageResource($message);
        event(new MessageCreated($message->receiver_id, $resource));
        return APIResponse::success($resource);
    }
}
