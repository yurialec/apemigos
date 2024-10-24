<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            ['module_id' => 1, 'name' => 'users.list', 'label' => 'Listar Usuários'],
            ['module_id' => 1, 'name' => 'users.create', 'label' => 'Cadastrar Usuários'],
            ['module_id' => 1, 'name' => 'users.edit', 'label' => 'Editar Usuário'],
            ['module_id' => 1, 'name' => 'users.delete', 'label' => 'Deletar Usuário'],
            ['module_id' => 1, 'name' => 'roles.list', 'label' => 'Listar Perfis'],
            ['module_id' => 1, 'name' => 'roles.create', 'label' => 'Cadastrar Perfil'],
            ['module_id' => 1, 'name' => 'roles.edit', 'label' => 'Editar Perfil'],
            ['module_id' => 1, 'name' => 'roles.delete', 'label' => 'Deletar Perfil'],
            ['module_id' => 1, 'name' => 'permissions.list', 'label' => 'Listar Permissões'],
            ['module_id' => 1, 'name' => 'permissions.create', 'label' => 'Cadastrar Permissão'],
            ['module_id' => 1, 'name' => 'permissions.edit', 'label' => 'Editar Permissão'],
            ['module_id' => 1, 'name' => 'permissions.delete', 'label' => 'Deletar Permissão'],
            ['module_id' => 1, 'name' => 'menu.list', 'label' => 'Listar Menus'],
            ['module_id' => 1, 'name' => 'menu.create', 'label' => 'Cadastrar Menu'],
            ['module_id' => 1, 'name' => 'menu.edit', 'label' => 'Editar Menu'],
            ['module_id' => 1, 'name' => 'menu.delete', 'label' => 'Deletar Menu'],
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->insert([
                'module_id'   => $permission['module_id'],
                'name'        => $permission['name'],
                'label'       => $permission['label'],
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ]);
        }
    }
}
