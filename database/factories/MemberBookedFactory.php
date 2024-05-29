<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MemberBooked>
 */
class MemberBookedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $members = Member::where('is_penalty', false)->pluck('id')->toArray();
        $books = Book::where('stock', '>', 0)->pluck('id')->toArray();
        return [
            'member_id' => $this->faker->randomElement($members),
            'book_id' => $this->faker->randomElement($books),
            'return_date' => null,
            'booked_date' => $this->faker->date(),
            'book_total' => 2,
        ];
    }
}