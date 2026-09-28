<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'user_id' => fn() => \App\Models\User::factory(),
            'title' => $this->faker->sentence(),
            'content' => $this->faker->sentence(),
            'image' => $this->faker->sentence(),
            'published' => $this->faker->boolean(),
        ];
    }
}
