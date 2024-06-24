<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface UserRepositoryContract
{
    /**
     * @param array $data
     * @return User
     */
    public function create(array $data): User;

    /**
     * @param User $user
     * @param array $data
     * @return bool
     */
    public function update(User $user, array $data): bool;

    /**
     * @param int $id
     * @return ?User
     */
    public function findById(int $id): ?User;

    /**
     * @param User $user
     * @return bool
     */
    public function delete(User $user): bool;
}