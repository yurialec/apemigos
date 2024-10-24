<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CadastrarUsuarioRequest;
use App\Services\Admin\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return view('admin.users.index');
    }

    public function list(Request $request)
    {
        $users = $this->userService->getAllUsers($request->input('search'));

        if ($users) {
            return response()->json([
                'status' => true,
                'users' => $users
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
        return view('admin.users.create');
    }

    public function store(CadastrarUsuarioRequest $request): JsonResponse
    {
        $user = $this->userService->createUser($request->all());

        if ($user) {
            return response()->json([
                'status' => true,
                'user' => $user,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao cadastrar usuário'
            ], 204);
        }
    }

    public function edit(string $id)
    {
        $user = $this->userService->getUserById($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = $this->userService->updateUser($id, $request->all());

        if ($user) {
            return response()->json([
                'status' => true,
                'user' => $user,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao atualizar usuário'
            ], 204);
        }
    }

    public function delete(string $id)
    {
        $user = $this->userService->deleteUser($id);

        if ($user) {
            return response()->json([
                'status' => true,
                'message' => 'Usuário excluio com sucesso',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao excluir usuário'
            ], 204);
        }
    }

    public function profileView()
    {
        return view('admin.users.profile');
    }

    public function profile(): JsonResponse
    {
        $profile = Auth::user();

        return response()->json([
            'status' => true,
            'profile' => $profile,
        ], 201);
    }
}
