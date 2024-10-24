<?php

namespace App\Services\Admin;

use App\Repositories\Admin\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers($term)
    {
        return $this->userRepository->all($term);
    }

    public function getUserById($id)
    {
        return $this->userRepository->find($id);
    }

    public function createUser($data)
    {
        return $this->userRepository->create($data);
    }

    public function updateUser($id, $data)
    {
        return $this->userRepository->update($id, $data);
    }

    public function deleteUser($id)
    {
        return Auth::id() != $id  ? $this->userRepository->delete($id) : false;
    }
}
