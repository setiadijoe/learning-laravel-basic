<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    /**
     * A basic feature test list Authors.
     *
     * @return void
     */
    public function testListAuthors()
    {
        $response = $this->get('/api/authors', ['Accept' => 'application/json', 'Content-Type' => 'application/json']);

        $response->assertStatus(200);
    }

    public function testAddAuthor()
    {
        $data = [
            'name' => 'JohnDoe',
        ];

        $response = $this->json('POST', '/api/authors', $data, ['Accept' => 'application/json', 'Content-Type' => 'application/json']);
        $response->assertStatus(Response::HTTP_CREATED);
    }
}
