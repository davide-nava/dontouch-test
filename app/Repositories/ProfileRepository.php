<?php

namespace App\Repositories;

use App\Models\Profile;

class ProfileRepository implements ProfileRepositoryInterface
{
    public function all()
    {
        return Profile::withTrashed()->with('attributes')->get();
    }

    public function create($data)
    {

        return Profile::create($data);
    }

    public function update($data)
    {
        $profile = Profile::findOrFail($data['id']);
        $profile->update($data);
        return $profile;
    }

    public function delete($id)
    {
        $profile = Profile::withTrashed()->findOrFail($id);
        $profile->softDeletes();
    }

    public function find($id)
    {
        return Profile::withTrashed()->with('attributes')->findOrFail($id);
    }
}
