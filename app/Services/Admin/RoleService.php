<?php

namespace App\Services\Admin;

use App\Repositories\Admin\RoleRepository;

class RoleService
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function getAllRoles($term)
    {
        return $this->roleRepository->all($term);
    }

    public function getRoleById($id)
    {
        return $this->roleRepository->find($id);
    }

    public function createRole($data)
    {
        return $this->roleRepository->create($data);
    }

    public function updateRole($id, $data)
    {
        return $this->roleRepository->update($id, $data);
    }

    public function deleteRole($id)
    {
        return $this->roleRepository->delete($id);
    }

    public function listPermissions()
    {
        return $this->roleRepository->listPermissions();
    }
}
