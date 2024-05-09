<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::select('id')->get()->random()->id,
            'title' => fake()->sentence,
            'description' => fake()->paragraphs(6, true),
            'price' => fake()->randomNumber(4),
            'stock' => fake()->randomNumber(2),
            'is_published' => fake()->boolean(),
            'created_at' => fake()->dateTimeBetween('-365 days', '-7 days'),
        ];
    }
}
