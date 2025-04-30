<?php

namespace App\Http\Requests\UserRequest;

use App\Enums\ErrorCode;
use App\Exceptions\AppException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'min:3|max:50',
            'address' => 'min:6|max:255',
            'phone_number' => [
                'regex:/^0(3[0-9]|5[6|8|9]|7[0|6-9]|8[1-9]|9[0-9])[0-9]{7}$/',
            ],
        ];
    }
    public function messages()
    {
        return [
            'name.min' => "USERNAME_SIZE",
            'name.max' => "USERNAME_SIZE",
            'address.min' => "ADDRESS_SIZE",
            'address.max' => "ADDRESS_SIZE",
            'phone_number.regex' => "PHONENUMBER_NOT_FORMAT",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errorName = $validator->errors()->first();
        throw new AppException(ErrorCode::getCaseName($errorName));
    }
}
