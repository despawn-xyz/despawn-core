<?php

namespace Despawn\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ProfileMediaUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'avatar' => ['nullable', 'mimes:jpeg,png,jpg,gif', 'max:1048'],
            'cover' => ['nullable', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function validateWithBag(string $errorBag, array $rules, ...$params): array
    {
        return ['updateProfileMedia'];
    }
}