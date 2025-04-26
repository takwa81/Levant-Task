<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Traits\ResultTrait;

class UserRequest extends FormRequest
{
    use ResultTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user') ?? null;

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $userId,
            'password' => $this->isMethod('post')
                ? 'required|string|min:8|confirmed|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/'
                : 'nullable|string|min:6|confirmed|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
            'image'   => $this->isMethod('post') ? 'required|image|max:2048' : 'nullable|image|max:2048',

        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('messages.validation.name_required'),
            'email.required' => __('messages.validation.email_required'),
            'email.email' => __('messages.validation.email_invalid'),
            'email.unique' => __('messages.validation.email_unique'),
            'password.required' => __('messages.validation.password_required'),
            'password.min' => __('messages.validation.password_min'),
            'password.confirmed' => __('messages.validation.password_confirmed'),
            'password.regex' => __('messages.validation.password_regex'),
            'image.image'      => __('messages.validation.image_type'),
            'image.max'        => __('messages.validation.image_max'),
            'image.required'        => __('messages.validation.image_reuired'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->errorResponse(__('messages.validation.error_occurred'), $validator->errors(), 422)
        );
    }
}