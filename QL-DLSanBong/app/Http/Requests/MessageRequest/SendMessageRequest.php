<?php

namespace App\Http\Requests\MessageRequest;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\ErrorCode;
use App\Exceptions\AppException;
use Illuminate\Contracts\Validation\Validator;

class SendMessageRequest extends FormRequest
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
            'content' => 'required|string',
            'thread_id' => ''
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => 'FIELD_CONTENT_REQUIRED',
            'content.string' => 'FIELD_CONTENT_MUST_BE_STRING',

            'thread_id.required' => 'FIELD_THREAD_ID_REQUIRED',
            'thread_id.string' => 'FIELD_THREAD_ID_MUST_BE_STRING',
            'thread_id.max' => 'FIELD_THREAD_ID_TOO_LONG',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errorName = $validator->errors()->first();
        throw new AppException(ErrorCode::getCaseName($errorName));
    }
}
