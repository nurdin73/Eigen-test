<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Member;
use App\Models\MemberBooked;
use App\Models\MemberPenalty;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class BookedTest extends TestCase
{
    protected function getBook()
    {
        $book = Book::where('stock', '>', 0)->inRandomOrder()->first();
        if (!$book) {
            $book = Book::create([
                'code' => Str::random(4),
                'title' => \Faker\Factory::create()->jobTitle(),
                'author' => \Faker\Factory::create()->name(),
                'stock' => 5
            ]);
        }
        return $book;
    }

    protected function getMember()
    {
        $member = Member::inRandomOrder()->first();
        if (!$member) {
            $member = Member::create([
                'code' => Str::random(4),
                'name' => \Faker\Factory::create()->name()
            ]);
        }
        return $member;
    }

    protected function createMember()
    {
        $member = Member::create([
            'code' => Str::random(4),
            'name' => \Faker\Factory::create()->name()
        ]);
        return $member;
    }
    /**
     * A basic feature test example.
     */
    public function test_member_booked_error_validation(): void
    {
        $member = $this->getMember();
        $response = $this->post("/api/members/{$member->id}/booking");

        $response->assertStatus(422)->assertJsonStructure([
            'message',
            'errors'
        ]);
    }

    public function test_member_not_available()
    {
        $book = $this->getBook();
        $response = $this->post("/api/members/2000/booking", [
            'books' => [
                [
                    'kode_buku' => $book->code,
                    'total' => 1
                ]
            ]
        ]);

        $response->assertStatus(404)->assertJsonStructure([
            'message'
        ]);
    }

    public function test_member_is_penalty_day()
    {
        $member = $this->getMember();

        $book = $this->getBook();

        $booked = MemberBooked::create([
            'member_id' => $member->id,
            'book_id' => $book->id,
            'booked_date' => now()
        ]);
        $book->stock -= 1;
        $book->save();
        MemberPenalty::create([
            'booked_id' => $booked->id,
            'member_id' => $member->id,
            'until' => now()->addDays(3),
        ]);
        $response = $this->post("/api/members/{$member->id}/booking", [
            'books' => [
                [
                    'kode_buku' => $book->code,
                    'total' => 1
                ]
            ]
        ]);

        $response->assertStatus(403)->assertJsonStructure([
            'message'
        ]);
    }

    public function test_member_booked_success()
    {
        $member = $this->createMember();
        $book = $this->getBook();

        $response = $this->post("/api/members/{$member->id}/booking", [
            'books' => [
                [
                    'kode_buku' => $book->code,
                    'total' => 1
                ]
            ]
        ]);

        $response->assertStatus(200)->assertJsonStructure([
            'message'
        ]);
    }
}
