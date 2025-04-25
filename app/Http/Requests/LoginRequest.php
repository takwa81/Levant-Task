<?php

namespace App\Http\Requests;

use App\Traits\ResultTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{
    use ResultTrait;
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
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => __('messages.validation.email_required'),
            'email.exists' => __('messages.validation.email_exists'),
            'email.email' => __('messages.validation.email_invalid'),
            'password.required' => __('messages.validation.password_required'),
            'password.min' => __('messages.validation.password_min'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->errorResponse(
                __('messages.validation.error_occurred'),
                $validator->errors(),
                422
            )
        );
    }
}
