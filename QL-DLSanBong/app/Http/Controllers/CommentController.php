<?php

namespace App\Http\Controllers;

use App\Events\CommentCreated;
use App\Events\CommentDeleted;
use App\Events\CommentUpdated;
use App\Http\Requests\CommentRequest\CreateCommentRequest;
use App\Http\Requests\CommentRequest\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Responses\APIResponse;
use App\Services\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    protected CommentService $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function findByFieldId(Request $request,$field_id)
    {
        $perPage = $request->get('per_page', 10); // Mặc định mỗi trang 10 field
        return APIResponse::paginated($this->commentService->findByFieldId($field_id,$perPage));
    }

    public function findById($comment_id)
    {
        return APIResponse::success($this->commentService->findById($comment_id));
    }

    public function store(CreateCommentRequest $commentRequest)
    {
        $data = $commentRequest->validated();
        $data["user_id"] = auth()->user()->id;
        $comment = $this->commentService->createComment($data);
        event(new CommentCreated($comment));
        return APIResponse::success($comment);
    }

    public function update(UpdateCommentRequest $commentRequest, string $id)
    {
        $data = $commentRequest->validated();
        $data["user_id"] = auth()->user()->id;
        $commentUpdate = $this->commentService->update($id, $data);
        event(new CommentUpdated($commentUpdate));
        return APIResponse::success($commentUpdate);
    }

    public function destroy(string $id)
    {
        $userCurrent = auth()->user()->id;
        $role = auth()->user()->is_admin;
        $commentId = $this->commentService->delete($id, $userCurrent, $role);
        event(new CommentDeleted($commentId));
        return APIResponse::success($commentId);
    }
}
