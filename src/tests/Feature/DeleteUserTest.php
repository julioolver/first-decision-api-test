<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class DeleteUserTest extends TestCase
{
    use RefreshDatabase;

    
    public function testShouldBeAbleToDeleteUserWithSuccess(): void
    {
        $user = User::factory()->create();

        $response = $this->deleteJson('/api/users/' . $user->id);

        if ($response->status() !== 204) {
            dd($response->json());
        }

        $response->assertStatus(204);
    }


    public function testShouldNotBeAbleToDeleteUserWithInvalidId(): void
    {
        $response = $this->deleteJson('/api/users/33333');

        if ($response->status() !== 404) {
            dd($response->json(), $response->status());
        }

        $response->assertStatus(404);
    }
}
