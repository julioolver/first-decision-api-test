<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class UserTest extends TestCase
{
    use RefreshDatabase;

    
    public function testShouldBeAbleToCreateUserWithSuccess(): void
    {
        $user= User::factory()->make();
        $userPayload = $user->toArray();
        $userPayload['password'] = '123456';
        $userPayload['password_confirmation'] = '123456';

        $response = $this->postJson('/api/users', $userPayload);
        
        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email,
        ]);
        $response->assertStatus(201);

        $response->assertJsonStructure([
            'data' => [
                'name',
                'email',
            ]
        ]);
    }
}
