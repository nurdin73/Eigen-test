<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
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
            'name' => $this->faker->name(),
            'is_penalty' => $this->faker->boolean()
        ];
    }
}
