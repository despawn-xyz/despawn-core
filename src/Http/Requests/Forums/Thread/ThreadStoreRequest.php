<?php

namespace Despawn\Http\Requests\Forums\Thread;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ThreadStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return (bool) $this->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:1', 'max:255'],
            'body' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->request->get('title')),
            'user_id' => $this->user()->id,
        ]);
    }
}