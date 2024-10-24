<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\RoleRepositoryInterface;
use App\Models\Admin\Permissions;
use App\Models\Admin\Roles;
use Exception;
use Illuminate\Support\Facades\Auth;

class RoleRepository implements RoleRepositoryInterface
{
    protected $role;
    protected $permissionRoles;
    protected $permissions;

    public function __construct(Roles $role, PermissionsRolesRepository $permissionRoles, Permissions $permissions)
    {
        $this->role = $role;
        $this->permissionRoles = $permissionRoles;
        $this->permissions = $permissions;
    }

    public function all($term)
    {
        return $this->role
            ->when($term, function ($query) use ($term) {
                return $query->where('name', 'like', '%' . $term . '%');
            })
            ->where('id', '>=', Auth::user()->role_id)
            ->paginate(10);
    }

    public function find($id)
    {
        return $this->role->find($id);
    }

    public function create(array $data)
    {
        return $this->role->create($data);
    }

    public function update($id, $data)
    {
        $role = $this->role->find($id);
        if ($role) {

            $role->update($data);

            if (isset($data['permissions']) && is_array($data['permissions'])) {

                $currentPermissions = $this->permissionRoles->all()->where('role_id', $role->id)->pluck('permission_id')->toArray();

                $permissionsToRemove = array_diff($currentPermissions, $data['permissions']);

                $permissionsToAdd = array_diff($data['permissions'], $currentPermissions);

                foreach ($permissionsToRemove as $permissionId) {
                    $this->permissionRoles->delete($permissionId, $role->id);
                }

                foreach ($permissionsToAdd as $permissionId) {
                    try {
                        $this->permissionRoles->create([
                            'permission_id' => $permissionId,
                            'role_id' => $role->id
                        ]);
                    } catch (Exception $err) {
                        return $err;
                    }
                }
            }

            return $role;
        }
    }

    public function delete($id)
    {
        $role = $this->role->find($id);
        if ($role) {
            $role->delete();
            return true;
        }
        return false;
    }

    public function listPermissions()
    {
        return $this->permissions->get();
    }
}
