<?php
declare(strict_types=1);

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:250'],
            'description' => ['sometimes', 'nullable', 'string', 'max:250'],
            'price' => ['required', 'integer'],
            'stock' => ['required', 'integer'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'image' => ['sometimes', 'nullable', 'string', 'max:250'],
        ];
    }
}
