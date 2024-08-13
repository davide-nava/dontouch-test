<?php

namespace App\Repositories;

use App\Models\ProfileAttribute;

class ProfileAttributeRepository implements ProfileAttributeRepositoryInterface
{
    public function all()
    {
        return ProfileAttribute::withTrashed()->get();
    }

    public function create($data)
    {
        return ProfileAttribute::create($data);
    }

    public function update($data)
    {
        $profileAttribute = ProfileAttribute::findOrFail($data["id"]);
        $profileAttribute->update($data);
        return $profileAttribute;
    }

    public function delete($id)
    {
        $profileAttribute = ProfileAttribute::withTrashed()->findOrFail($id);
        $profileAttribute->softDeletes();
    }

    public function find($id)
    {
        return ProfileAttribute::withTrashed()->findOrFail($id);
    }
}
