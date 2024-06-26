<?php

namespace Tests\Unit\User;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\Eloquent\UserRepository;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    private UserRepositoryContract $repository;
    public function setUp(): void
    {
        parent::setUp();

        /** @var UserRepository $this->repository */
        $this->repository = $this->app->make(UserRepositoryContract::class);
    }

    public function testShouldBeAbleToCreateUserWithSuccess()
    {
        $user= User::factory()->make();

        $userPayload = $user->toArray();
        $userPayload['password'] = '123456';
        $userPayload['password_confirmation'] = '123456';

        $userResult = $this->repository->create($userPayload);

        $this->assertDatabaseHas('users', ['email' => $user->email]);
        $this->assertEquals($user->email, $userResult->email);
    }
}