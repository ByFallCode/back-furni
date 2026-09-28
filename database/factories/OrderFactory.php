<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'user_id' => fn() => \App\Models\User::factory(),
            'customer_name' => $this->faker->sentence(),
            'email' => $this->faker->sentence(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->sentence(),
            'city' => $this->faker->sentence(),
            'country' => $this->faker->sentence(),
            'notes' => $this->faker->sentence(),
            'status' => $this->faker->sentence(),
            'total' => $this->faker->numberBetween(1, 9999),
        ];
    }
}
