<?php

namespace App\Interfaces\Admin;

interface PermissionRepositoryInterface
{
    public function all($term);
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
