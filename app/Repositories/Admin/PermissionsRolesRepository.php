<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\PermissionsRolesRepositoryInterface;
use App\Models\Admin\PermissionsRoles;

class PermissionsRolesRepository implements PermissionsRolesRepositoryInterface
{
    protected $permissionsRoles;

    public function __construct(PermissionsRoles $permissionsRoles)
    {
        $this->permissionsRoles = $permissionsRoles;
    }

    public function all()
    {
        return $this->permissionsRoles->get();
    }

    public function create($data)
    {
        return $this->permissionsRoles->create($data);
    }

    public function delete($permissionId, $roleId)
    {
        return $this->permissionsRoles->where('permission_id', $permissionId)
            ->where('role_id', $roleId)
            ->delete();
    }
}
