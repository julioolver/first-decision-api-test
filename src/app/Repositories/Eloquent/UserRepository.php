<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;

class UserRepository implements UserRepositoryContract
{
    public function __construct(protected User $model)
    {
    }

    /**
     * @param array $data
     * @return User
     */
    public function create(array $data): User
    {
        return $this->model->create($data);
    }

    /**
     * @param User $user
     * @param array $data
     * @return User
     */
    public function update(User $user, array $data): bool
    {
        return $user->update($data);
    }

    /**
     * @param int $id
     * @return ?User
     */
    public function findById(int $id): ?User
    {
        return $this->model->find($id);
    }

    public function delete(User $user): bool
    {
        return $user->delete();
    }
}