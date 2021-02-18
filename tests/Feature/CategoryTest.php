<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testListCategory()
    {
        $response = $this->json('GET','/api/categories', ['Accept' => 'application/json']);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function testAddCategory()
    {
        $data = [
            'name' => 'Foo bar',
        ];

        $response = $this->json('POST', '/api/categories', $data, ['Accept' => 'application/json', 'Content-Type' => 'application/json']);
        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function testAddCategoryWithoutBody()
    {
        $data = null;

        $response = $this->json('PUT'. '/api/categories', $data, ['Accept' => 'application/json', 'Content-Type' => 'application/json']);
        $response->assertStatus(Response::HTTP_NO_CONTENT);
        $response->assertJsonValidationErrors('The name field is required', 'errors');
    }
}
