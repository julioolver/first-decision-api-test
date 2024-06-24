<?php

namespace App\Repositories\Eloquent;

use App\Models\User;

class UserRepository
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
}