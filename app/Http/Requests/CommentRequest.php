<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Traits\ResultTrait;

class CommentRequest extends FormRequest
{
    use ResultTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'comment' => 'required|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'comment.required' => __('messages.validation.comment_required'),
            'comment.string'   => __('messages.validation.comment_string'),
            'comment.max'      => __('messages.validation.comment_max'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->errorResponse(__('messages.validation.error_occurred'), $validator->errors(), 422)
        );
    }
}