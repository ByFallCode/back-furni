<?php
declare(strict_types=1);

namespace App\Http\Requests\OrderItem;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'order_id' => ['required', 'integer', 'exists:orders,id'],
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer'],
            'unit_price' => ['required', 'numeric'],
            'subtotal' => ['required', 'numeric'],
        ];
    }
}
