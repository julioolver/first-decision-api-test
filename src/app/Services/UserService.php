<?php

namespace App\Services;

use App\Exceptions\UserNotFoundException;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    public function __construct(protected UserRepositoryContract $userRepository)
    {
    }

    /**
     * @return Collection|User[]
     */
    public function getAll(): Collection
    {
        return $this->userRepository->getAll();
    }

    public function create(array $data): User
    {
        $data['password'] = bcrypt($data['password']);

        return $this->userRepository->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $user = $this->findById($id);

        if (array_key_exists('password', $data)) {
            $data['password'] = app('hash')->make($user['password']);
        }

        return $this->userRepository->update($user, $data);
    }

    public function findById(int $id): ?User
    {
        return $this->userRepository->findById($id);
    }

    public function delete(int $id): bool
    {
        $user = $this->findById($id);

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $this->userRepository->delete($user);
    }
}
