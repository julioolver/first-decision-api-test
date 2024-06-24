<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class ListAllUsersTest extends TestCase
{
    use RefreshDatabase;

    
    public function testShouldBeAbleToListAllUsers(): void
    {
        User::factory(11)->create();

        $response = $this->getJson('/api/users/');

        if ($response->status() !== 200) {
            dd($response->json());
        }

        $response->assertStatus(200);
        $response->assertJsonCount(11, 'data');
    }
}
