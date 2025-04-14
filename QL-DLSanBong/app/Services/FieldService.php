<?php

namespace App\Services;

use App\Enums\ErrorCode;
use App\Exceptions\AppException;
use App\Repositories\FieldRepository;

class FieldService
{
    protected $repository;

    public function __construct(FieldRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
//        throw new AppException(ErrorCode::UNCATEGORIZED_EXCEPTION);

        return $this->repository->getAll();
    }

    public function paginate($perPage = 10)
    {
        return $this->repository->paginate($perPage);
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

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
