<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->numberBetween(1, 9999),
            'stock' => $this->faker->numberBetween(1, 9999),
            'user_id' => fn() => \App\Models\User::factory(),
            'image' => $this->faker->sentence(),
        ];
    }
}
