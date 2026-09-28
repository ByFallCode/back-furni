<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition(): array
    {
        return [
            'order_id' => fn() => \App\Models\Order::factory(),
            'product_id' => fn() => \App\Models\Product::factory(),
            'quantity' => $this->faker->numberBetween(1, 9999),
            'unit_price' => $this->faker->sentence(),
            'subtotal' => $this->faker->sentence(),
        ];
    }
}
