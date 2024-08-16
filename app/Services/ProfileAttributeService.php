<?php

namespace App\Services;

use App\Repositories\ProfileAttributeRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class ProfileAttributeService implements ProfileAttributeRepositoryInterface
{
    public function __construct(protected ProfileAttributeRepositoryInterface $profileAttributeRepository)
    {
    }

    public function create($data)
    {
        Cache::forget('profile_attributes');

        return $this->profileAttributeRepository->create($data);
    }

    public function update($data)
    {
        Cache::forget('profile_attributes');

        return $this->profileAttributeRepository->update($data);
    }

    public function delete($id)
    {
        Cache::forget('profile_attributes');

        return $this->profileAttributeRepository->delete($id);
    }

    public function all()
    {
        return Cache::remember('profile_attributes', 60, function () {
            return $this->profileAttributeRepository->all();
        });
    }

    public function find($id)
    {
        // if (Cache::has('profile_attributes')) {
        //     // ...
        // }

        return $this->profileAttributeRepository->find($id);
    }
}
