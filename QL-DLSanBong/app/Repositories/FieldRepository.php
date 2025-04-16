<?php
namespace App\Repositories;

use App\Models\Field;

class FieldRepository
{
    protected $model;

    public function __construct(Field $field)
    {
        $this->model = $field;
    }

    public function getAll()
    {
        return $this->model->with(['category', 'state', 'images'])->get();
    }

    public function paginate($perPage = 10)
    {
        return $this->model->with(['category', 'state', 'images'])->paginate($perPage);
    }

    public function find($id)
    {
        return $this->model->with(['category', 'state', 'images'])->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $field = $this->model->findOrFail($id);
        $field->update($data);
        return $field;
    }

    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    public function findByIdAndIsDeleted($fieldId,$isDeleted)
    {
        return Field::where('id', $fieldId)
            ->whereNull('deleted_at')
            ->first();
    }
}
