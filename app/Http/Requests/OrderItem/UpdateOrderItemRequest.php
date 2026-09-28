<?php
declare(strict_types=1);

namespace App\Http\Requests\OrderItem;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'order_id' => ['sometimes', 'integer', 'exists:orders,id'],
            'product_id' => ['sometimes', 'integer', 'exists:products,id'],
            'quantity' => ['sometimes', 'integer'],
            'unit_price' => ['sometimes', 'numeric'],
            'subtotal' => ['sometimes', 'numeric'],
        ];
    }
}
