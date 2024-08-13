<?php

namespace App\Services;

use App\Repositories\ProfileAttributeRepositoryInterface;

class ProfileAttributeService implements ProfileAttributeRepositoryInterface
{
    public function __construct(protected ProfileAttributeRepositoryInterface $profileAttributeRepository)
    {
    }

    public function create(array $data)
    {
        return $this->profileAttributeRepository->create($data);
    }

    public function update(array $data)
    {
        return $this->profileAttributeRepository->update($data);
    }

    public function delete($profile_id, $attribute)
    {
        return $this->profileAttributeRepository->delete($profile_id, $attribute);
    }

    public function all()
    {
        return $this->profileAttributeRepository->all();
    }

    public function find($profile_id, $attribute)
    {
        return $this->profileAttributeRepository->find($profile_id, $attribute);
    }
}
