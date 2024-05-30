<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class BookCheckTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_book_check_response_success(): void
    {
        $response = $this->get('/api/books');

        $response->assertStatus(200)->assertJsonStructure([
            [
                'id',
                'code',
                'title',
                'author',
                'stock'
            ]
        ]);
    }

    public function test_book_check_empty_list(): void
    {
        $response = $this->get('/api/books');

        $response->assertStatus(200)->assertJsonIsArray();
    }
}
