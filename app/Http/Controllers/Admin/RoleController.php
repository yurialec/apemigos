<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\CreateRoleRequest;
use App\Http\Requests\Admin\Role\UpdateRoleRequest;
use App\Models\Admin\Roles;
use App\Services\Admin\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $roleService;
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        return view('admin.roles.index');
    }

    public function list(Request $request)
    {
        $roles = $this->roleService->getAllRoles($request->input('search'));

        if ($roles) {
            return response()->json([
                'status' => true,
                'roles' => $roles
            ], 200);
        } else {
            return response()->json([
                'message' => 'Nenhum registro encontrado.',
                'status' => 204
            ]);
        }
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(CreateRoleRequest $request)
    {
        $role = $this->roleService->createRole($request->all());

        if ($role) {
            return response()->json([
                'status' => true,
                'role' => $role,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao cadastrar perfil'
            ], 204);
        }
    }

    public function edit(string $id)
    {
        $role = Roles::where('id', $id)->first();
        return view('admin.roles.edit', compact('role'));
    }

    public function update(UpdateRoleRequest $request, string $id)
    {
        $role = $this->roleService->updateRole($id, $request->all());

        if ($role) {
            return response()->json([
                'status' => true,
                'role' => $role,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao atualizar perfil'
            ], 204);
        }
    }

    public function delete(string $id)
    {
        $role = $this->roleService->deleteRole($id);
        if ($role) {
            return response()->json([
                'status' => true,
                'message' => 'Perfil excluio com sucesso',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao excluir perfil'
            ], 204);
        }
    }
}
