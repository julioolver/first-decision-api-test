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
        $user = $this->findOrFail($id);

        if ($this->isPasswordChangeRequested($data)) {
            $this->validateCurrentPassword($data['current_password'], $user->password);
            
            $data['password'] = app('hash')->make($data['password']);
        } else {
            unset($data['password']);
        }

        unset($data['current_password'], $data['password_confirmation']);

        return $this->userRepository->update($user, $data);
    }

    private function isPasswordChangeRequested(array $data): bool
    {
        return isset($data['current_password'], $data['password']) &&
            !empty($data['current_password']) && !empty($data['password']);
    }

    private function validateCurrentPassword(string $currentPassword, string $storedPassword): void
    {
        if (!app('hash')->check($currentPassword, $storedPassword)) {
            throw new \Exception('Current password is incorrect');
        }
    }

    public function findById(int $id): ?User
    {
        return $this->userRepository->findById($id);
    }

    /**
     * Encontra um usuário por ID ou lança uma exceção
     *
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    protected function findOrFail(int $id): User
    {
        $user = $this->findById($id);

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    public function delete(int $id): bool
    {
        $user = $this->findOrFail($id);

        return $this->userRepository->delete($user);
    }
}
