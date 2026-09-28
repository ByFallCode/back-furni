<?php
declare(strict_types=1);

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:4294967295'],
            'image' => ['sometimes', 'nullable', 'string', 'max:255'],
            'published' => ['sometimes', 'integer'],
        ];
    }
}
