<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'email' => $this->faker->sentence(),
            'subject' => $this->faker->sentence(),
            'message' => $this->faker->sentence(),
            'status' => $this->faker->sentence(),
        ];
    }
}
