<?php

namespace App\Exceptions;

use App\Enums\ErrorCode;
use Exception;

class AppException extends Exception
{
    protected $errorCode;
    //
    public function __construct(ErrorCode $errorCode)
    {
        $this->errorCode = $errorCode;
        parent::__construct($errorCode->message());
    }

    public function getErrorCode(){
        return $this->errorCode;
    }

    public function render($request)
    {
        return response()->json([
            'message' => $this->errorCode->message(),
            'code' => $this->errorCode->code(),
        ], $this->errorCode->httpStatus());
    }
}
