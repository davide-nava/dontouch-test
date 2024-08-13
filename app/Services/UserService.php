<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;

class UserService implements UserRepositoryInterface
{
    public function __construct(protected UserRepositoryInterface $userRepository)
    {
    }

    public function create(array $data)
    {
        return $this->userRepository->create($data);
    }

    public function update(array $data)
    {
        return $this->userRepository->update($data);
    }

    public function delete($id)
    {
        return $this->userRepository->delete($id);
    }

    public function all()
    {
        return $this->userRepository->all();
    }

    public function find($id)
    {
        return $this->userRepository->find($id);
    }
}
