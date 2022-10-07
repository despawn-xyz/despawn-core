<?php

namespace Despawn\Http\Requests\Forums\Comment;

use Despawn\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CommentStoreRequest extends FormRequest
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
            'body' => ['required', 'string'],
            'commenter_id' => ['required', 'exists:users,id'],
            'commenter_type' => ['required'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'commenter_id' => $this->user()->id,
            'commenter_type' => User::class,
        ]);
    }
}
