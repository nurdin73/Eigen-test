<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MemberCheckTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_member_check_response_success(): void
    {
        $response = $this->get('/api/members');

        $response->assertStatus(200)->assertJsonStructure([
            [
                'id',
                'code',
                'name',
                'book_borrowed',
            ]
        ]);
    }

    /**
     * A basic feature test example.
     */
    public function test_member_check_response_empty_list(): void
    {
        $response = $this->get('/api/members');

        $response->assertStatus(200)->assertJsonIsArray();
    }
}
