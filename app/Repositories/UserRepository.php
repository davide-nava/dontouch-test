<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function all()
    {
        return User::all();
    }

    public function create(  $data)
    {
        return User::create($data);
    }

    public function update(  $data)
    {
        $user = User::findOrFail($data['id']);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->softDeletes();
    }

    public function find($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return $user;
    }
}
