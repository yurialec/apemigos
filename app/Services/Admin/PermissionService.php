<?php

namespace App\Services\Admin;

use App\Repositories\Admin\PermissionRepository;

class PermissionService
{
    protected $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function getAllPermissions($term)
    {
        return $this->permissionRepository->all($term);
    }

    public function getPermissionById($id)
    {
        return $this->permissionRepository->find($id);
    }

    public function storePermission($data)
    {
        return $this->permissionRepository->create($data);
    }

    public function updatePermission($id, $data)
    {
        return $this->permissionRepository->update($id, $data);
    }

    public function deletePermission($id)
    {
        return $this->permissionRepository->delete($id);
    }
}
