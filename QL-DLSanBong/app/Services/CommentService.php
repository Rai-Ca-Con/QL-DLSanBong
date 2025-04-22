<?php

namespace App\Services;

use App\Enums\ErrorCode;
use App\Exceptions\AppException;
use App\Http\Resources\CommentResource;
use App\Repositories\BookingRepository;
use App\Repositories\Comment;
use App\Repositories\CommentRepository;
use App\Repositories\FieldRepository;
use App\Repositories\UserRepository;
use App\Responses\PaginateResponse;
use Illuminate\Support\Facades\Log;

class CommentService
{
    protected UserRepository $userRepository;
    protected CommentRepository $commentRepository;
    protected FieldRepository $fieldRepository;
    protected BookingRepository $bookingRepository;

    public function __construct(CommentRepository $commentRepository, UserRepository $userRepository, FieldRepository $fieldRepository, BookingRepository $bookingRepository)
    {
        $this->userRepository = $userRepository;
        $this->commentRepository = $commentRepository;
        $this->fieldRepository = $fieldRepository;
        $this->bookingRepository = $bookingRepository;
    }

    public function findById($id)
    {
        $existComment = $this->commentRepository->findByIdAndIsDeleted($id);
        if ($existComment == null) {
            throw new AppException(ErrorCode::COMMENT_NON_EXISTED);
        }
        return new CommentResource($existComment);
    }

    public function paginate($perPage)
    {
        $comments = $this->commentRepository->paginate($perPage);
        return PaginateResponse::paginateToJsonForm($comments);
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

        $userBookedField = $this->bookingRepository->findByUserAndField($user->id, $field->id);
        if (!($userBookedField > 0)) {
            throw new AppException(ErrorCode::UNAUTHORIZED_ACTION);
        }

        $data["status"] = 0;
        $comment = $this->commentRepository->create($data);

        return new CommentResource($comment);
    }

    public function update($id, array $data)
    {
        $existComment = $this->commentRepository->findByIdAndIsDeleted($id);

        if ($existComment == null) {
            throw new AppException(ErrorCode::COMMENT_NON_EXISTED);
        }

        $user = $existComment->user_id;

        if ($user != $data["user_id"]) {
            throw new AppException(ErrorCode::UNAUTHORIZED);
        }

        $commentUpdate = $this->commentRepository->update($id, $data);

        return new CommentResource($commentUpdate);
    }

    public function delete($id, $currentUser, $role)
    {
        $existComment = $this->commentRepository->findByIdAndIsDeleted($id);

        if ($existComment == null) {
            throw new AppException(ErrorCode::COMMENT_NON_EXISTED);
        }

        if (!($currentUser == $existComment->user_id || $role == 1)) { // fix lai
            throw new AppException(ErrorCode::UNAUTHORIZED);
        }

        return $this->commentRepository->delete($id);
    }
}
