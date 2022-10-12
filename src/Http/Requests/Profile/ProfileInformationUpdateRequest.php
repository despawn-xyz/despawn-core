<?php

namespace Despawn\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ProfileInformationUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email'],
            'avatar' => ['nullable', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function validateWithBag(string $errorBag, array $rules, ...$params): array
    {
        return ['updateProfileInformation'];
    }
}