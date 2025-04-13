<?php
namespace App\Repositories;

use App\Models\Field;

class FieldRepository
{
    public function getAll()
    {
        return Field::all();
    }

    public function findById($id)
    {
        return Field::findOrFail($id);
    }

    public function create(array $data)
    {
        return Field::create($data);
    }
}