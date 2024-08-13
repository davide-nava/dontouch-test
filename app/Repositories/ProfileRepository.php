<?php

namespace App\Repositories;

use App\Models\Profile;

class ProfileRepository implements ProfileRepositoryInterface
{
    public function all()
    {
        return Profile::withTrashed()->get();
    }

    public function create(array $data)
    {

        return Profile::create($data);
    }

    public function update(array $data)
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
        return Profile::withTrashed()->findOrFail($id);
    }
}
