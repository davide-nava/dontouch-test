<?php

namespace App\Repositories;

use App\Models\ProfileAttribute;

class ProfileAttributeRepository implements ProfileAttributeRepositoryInterface
{
    public function all()
    {
        return ProfileAttribute::withTrashed()->get();
    }

    public function create(array $data)
    {
        return ProfileAttribute::create($data);
    }

    public function update(array $data)
    {
        $profileAttribute = ProfileAttribute::where('profile_id', $data['profile_id'])->where('attribute', $data['attribute'])->firstOrFail();
        $profileAttribute->update($data);
        return $profileAttribute;
    }

    public function delete($profile_id, $attribute)
    {
        $profileAttribute = ProfileAttribute::where('profile_id', $profile_id)->where('attribute', $attribute)->withTrashed()->firstOrFail();
        $profileAttribute->softDeletes();
    }

    public function find($profile_id, $attribute)
    {
        return ProfileAttribute::where('profile_id', $profile_id)->where('attribute', $attribute)->withTrashed()->firstOrFail();
    }
}
