<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\PermissionRepositoryInterface;
use App\Models\Admin\Permissions;

class PermissionRepository implements PermissionRepositoryInterface
{
    protected $permission;

    public function __construct(Permissions $permission)
    {
        $this->permission = $permission;
    }

    public function all($term = null)
    {
        return $this->permission
            ->when($term, function ($query) use ($term) {
                return $query->where('name', 'like', '%' . $term . '%');
            })
            ->paginate(10);
    }

    public function find($id)
    {
        return $this->permission->find($id);
    }

    public function create(array $data)
    {
        return $this->permission->create($data);
    }

    public function update($id, array $data)
    {
        $permission = $this->permission->find($id);
        if ($permission) {
            $permission->update($data);
            return $permission;
        }
        return null;
    }

    public function delete($id)
    {
        $permission = $this->permission->find($id);
        if ($permission) {
            $permission->delete();
            return true;
        }
        return false;
    }

    public function list()
    {
        return $this->permission->get();
    }
}
