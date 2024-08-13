<?php

namespace App\Repositories;

interface ProfileRepositoryInterface
{
    public function delete($id);

    public function find($id);

    public function all();

    public function create($data);

    public function update($data);
}
