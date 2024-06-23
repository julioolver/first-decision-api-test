<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function testShouldBeAbleToCreateUserWithSuccess(): void
    {
        $user= User::factory()->create();
        $userPayload = $user->toArray();

        $response = $this->postJson('/api/users', $userPayload);
        
        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email,
        ]);
        $response->assertStatus(201);
        $response->assertJson($userPayload);

        $response->assertJsonStructure([
            'data' => [
                'name',
                'email',
            ]
        ]);
    }
}
