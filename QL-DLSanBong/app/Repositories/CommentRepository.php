<?php
namespace App\Repositories;

use App\Models\Comment;

class CommentRepository
{
    public function paginate($perPage = 10)
    {
    }

    public function findByFieldIdAndStatus($fieldId,$perPage = 10)
    {
        return Comment::where('field_id', $fieldId)
            ->where('status', 0)
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
    }

    public function delete($id)
    {
        return Comment::findOrFail($id)->delete();
    }
}
