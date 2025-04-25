<?php

namespace App\Http\Requests;

use App\Traits\ResultTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostRequest extends FormRequest
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
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'required|image|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'   => __('messages.validation.title_required'),
            'title.string'     => __('messages.validation.title_string'),
            'title.max'        => __('messages.validation.title_max'),

            'content.required' => __('messages.validation.content_required'),
            'content.string'   => __('messages.validation.content_string'),

            'image.image'      => __('messages.validation.image_type'),
            'image.max'        => __('messages.validation.image_max'),
            'image.required'        => __('messages.validation.image_reuired'),

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
