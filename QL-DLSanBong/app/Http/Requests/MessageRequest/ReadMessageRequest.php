<?php

namespace App\Http\Requests\MessageRequest;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\ErrorCode;
use App\Exceptions\AppException;
use Illuminate\Contracts\Validation\Validator;

class ReadMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'thread_id' => 'required|exists:threads,id'
        ];
    }

    public function messages(): array
    {
        return [
            'thread_id.required' => 'FIELD_THREAD_ID_REQUIRED',
            'thread_id.exists' => 'THREAD_NON_EXISTED_OR_NON_PERMISSION'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errorName = $validator->errors()->first();
        throw new AppException(ErrorCode::getCaseName($errorName));
    }
}
