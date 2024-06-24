<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Eloquent\UserRepository;

class UserService
{
    public function __construct(protected UserRepository $userRepository)
    {
    }

    public function create(array $data): User
    {
        return $this->userRepository->create($data);
    }
}