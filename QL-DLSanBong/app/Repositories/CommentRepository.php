<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository
{
    public function findByFieldId($fieldId,$perPage = 10)
    {
        return Comment::where('field_id', $fieldId)
        ->orderBy('created_at', 'desc')
        ->paginate($perPage);
    }

    public function findByIdAndIsDeleted($commentId)
    {
        return Comment::where('id', $commentId)
            ->whereNull('deleted_at')
            ->first();
    }

    public function create(array $data)
    {
        return Comment::create($data);
    }

    public function update($id, array $data)
    {
        $comment = $this->findByIdAndIsDeleted($id);

        $comment->update([
            'content' => $data['content'],
        ]);

        return $comment->fresh();
    }

    public function delete($id)
    {
        $isDeleted = Comment::findOrFail($id)->delete();
        if ($isDeleted) {
            return $id;
        }
        return false;
    }
}
