<?php

namespace App\Repositories;

interface ProfileAttributeRepositoryInterface
{
    public function delete($profile_id, $attribute);

    public function find($profile_id, $attribute);

    public function all();

    public function create(array $data);

    public function update(array $data);
}
