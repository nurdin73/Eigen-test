<?php

namespace Database\Factories;

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
            'code' => "{$this->faker->randomLetter()}-{$this->faker->randomDigitNotZero()}",
            'title' => $this->faker->words(4, true),
            'author' => $this->faker->name(),
            'stock' => $this->faker->randomDigitNotZero()
        ];
    }
}
