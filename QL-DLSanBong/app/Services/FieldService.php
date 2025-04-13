<?php

namespace App\Services;

use App\Enums\ErrorCode;
use App\Exceptions\AppException;
use App\Repositories\FieldRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FieldService
{
    protected $fieldRepository;

    public function __construct(FieldRepository $fieldRepository)
    {
        $this->fieldRepository = $fieldRepository;
    }

    public function getAllField()
    {
        throw new AppException(ErrorCode::UNCATEGORIZED_EXCEPTION);
    }

    public function createField(Request $request) {}
}
