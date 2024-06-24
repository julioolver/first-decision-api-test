<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class UpdateUserTest extends TestCase
{
    use RefreshDatabase;

    
    public function testShouldBeAbleToUpdateUserWithSuccess(): void
    {
        $user = User::factory()->create();

        $userPayload = [
            'name' => 'Julio editado',
            'email' => 'julio@julio.com',
            'password' => '123456',
            'password_confirmation' => '123456',
        ];

        $response = $this->putJson('/api/users/' . $user->id, $userPayload);

        if ($response->status() !== 200) {
            dd($response->json());
        }

        $this->assertDatabaseHas('users', [
            'name' => 'Julio editado',
            'email' => 'julio@julio.com',
        ]);
        $response->assertStatus(200);
    }


    public function testShouldNotBeAbleToUpdateUserWithoutName(): void
    {
        $user = User::factory()->create();

        $userPayload = [
            'email' => 'julio@julio.com',
            'password' => '123456',
            'password_confirmation' => '123456',
        ];

        $response = $this->putJson('/api/users/' . $user->id, $userPayload);

        $response->assertStatus(422);
    }
}
