<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\Eloquent\UserRepository;

class UserService
{
    public function __construct(protected UserRepositoryContract $userRepository)
    {
    }

    public function create(array $data): User
    {
        $data['password'] = bcrypt($data['password']);

        return $this->userRepository->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $user = $this->findById($id);
        return $this->userRepository->update($user, $data);
    }

    public function findById(int $id): ?User
    {
        return $this->userRepository->findById($id);
    }
}