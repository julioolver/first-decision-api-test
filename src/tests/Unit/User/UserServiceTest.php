<?php

namespace Tests\Unit\Services;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Services\UserService;
use Tests\TestCase;
use Mockery;

class UserServiceTest extends TestCase
{
    protected $userRepository;
    protected UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = Mockery::mock(UserRepositoryContract::class);
        $this->userService = new UserService($this->userRepository);
    }

    public function testShouldBeAbleToCreateUserWithSuccess()
    {
        $user = User::factory()->make();
        $userPayload = $user->toArray();
        $userPayload['password'] = '123456';
        $userPayload['password_confirmation'] = '123456';

        $this->userRepository->shouldReceive('create')
            ->once()
            ->with(Mockery::on(function ($arg) use ($userPayload) {
                return $arg['email'] === $userPayload['email'];
            }))
            ->andReturn($user);

        $userResult = $this->userService->create($userPayload);

        $this->assertEquals($user->email, $userResult->email);
    }
}
