<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\UpdateRoleRequest;
use App\Services\Admin\PermissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PermissionController extends Controller
{
    protected $permissionService;
    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function index()
    {
        return view('admin.permissions.index');
    }

    public function list(Request $request)
    {
        $permission = $this->permissionService->getAllPermissions($request->input('search'));

        if ($permission) {
            return response()->json([
                'status' => true,
                'permission' => $permission
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
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        $permission = $this->permissionService->storePermission($request->all());

        if ($permission) {
            return response()->json([
                'status' => true,
                'permission' => $permission,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao cadastrar permissão'
            ], 204);
        }
    }

    public function edit(string $id)
    {
        $permission = $this->permissionService->getPermissionById($id);
        if ($permission) {
            return view('admin.permissions.edit', compact('permission'));
        } else {
            return redirect(route('permissions.index'))->withErrors(['message' => 'Permissão não encontrado']);
        }
    }

    public function update(UpdateRoleRequest $request, string $id)
    {
        $permission = $this->permissionService->updatePermission($id, $request->all());

        if ($permission) {
            return response()->json([
                'status' => true,
                'permission' => $permission,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao atualizar permissão'
            ], 204);
        }
    }

    public function delete(string $id)
    {
        $permission = $this->permissionService->deletePermission($id);
        if ($permission) {
            return response()->json([
                'status' => true,
                'message' => 'Permissão excluio com sucesso',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao excluir permissão'
            ], 204);
        }
    }
}
