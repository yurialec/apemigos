<?php

namespace App\Interfaces\Admin;

interface PermissionsRolesRepositoryInterface
{
    public function all();
    public function create($data);
    public function delete($permissionId, $roleId);
}
