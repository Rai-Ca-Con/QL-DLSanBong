<?php

namespace App\Services;

use App\Enums\ErrorCode;
use App\Exceptions\AppException;
use App\Http\Resources\CommentResource;
use App\Repositories\Comment;
use App\Repositories\CommentRepository;
use App\Repositories\FieldRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Log;

class CommentService
{
    protected UserRepository $userRepository;
    protected CommentRepository $commentRepository;
    protected FieldRepository $fieldRepository;

    public function __construct(CommentRepository $commentRepository, UserRepository $userRepository, FieldRepository $fieldRepository)
    {
        $this->userRepository = $userRepository;
        $this->commentRepository = $commentRepository;
        $this->fieldRepository = $fieldRepository;

    }

    public function findById($id)
    {
//        $field = $this->repository->find($id);

        if (!$this->repository->find($id)) {
            throw new AppException(ErrorCode::FIELD_NOT_FOUND);
        }
        $field = $this->repository->find($id);

        return $field;
    }

    public function createComment(array $data)
    {
        $user = $this->userRepository->findById($data['user_id']);
        $field = $this->fieldRepository->findByIdAndIsDeleted($data['field_id'], null);

        if ($user == null) {
            throw new AppException(ErrorCode::USER_NON_EXISTED);
        }

        if ($field == null) {
            throw new AppException(ErrorCode::FIELD_NOT_FOUND);
        }

        $data["status"] = 0;
        $comment = $this->commentRepository->create($data);

        return new CommentResource($comment);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id, $currentUser, $role)
    {
        $existComment = $this->commentRepository->findByIdAndIsDeleted($id);

        if ($existComment == null) {
            throw new AppException(ErrorCode::COMMENT_NON_EXISTED);
        }

//        if(!($currentUser === $existComment->user_id || $role == 1)){ // fix lai
        if ($currentUser != $existComment->user_id) {
            throw new AppException(ErrorCode::UNAUTHORIZED);
        }

        return $this->commentRepository->delete($id);
    }
}
