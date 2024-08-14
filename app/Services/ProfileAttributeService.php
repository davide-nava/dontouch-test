<?php

namespace App\Services;

use App\Repositories\ProfileAttributeRepositoryInterface;

class ProfileAttributeService implements ProfileAttributeRepositoryInterface
{
    public function __construct(protected ProfileAttributeRepositoryInterface $profileAttributeRepository)
    {
    }

    public function create($data)
    {
        return $this->profileAttributeRepository->create($data);
    }

    public function update($data)
    {
        return $this->profileAttributeRepository->update($data);
    }

    public function delete($id)
    {
        return $this->profileAttributeRepository->delete($id);
    }

    public function all()
    {
        return $this->profileAttributeRepository->all();
    }

    public function find($id)
    {
        return $this->profileAttributeRepository->find($id);
    }
}
