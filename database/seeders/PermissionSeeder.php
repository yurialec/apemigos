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

            ['module_id' => 1, 'name' => 'users.index', 'label' => 'Listar Usuários'],
            ['module_id' => 1, 'name' => 'users.create', 'label' => 'Cadastrar Usuários'],
            ['module_id' => 1, 'name' => 'users.edit', 'label' => 'Editar Usuário'],
            ['module_id' => 1, 'name' => 'users.delete', 'label' => 'Deletar Usuário'],
            ['module_id' => 1, 'name' => 'roles.index', 'label' => 'Listar Perfis'],
            ['module_id' => 1, 'name' => 'roles.create', 'label' => 'Cadastrar Perfil'],
            ['module_id' => 1, 'name' => 'roles.edit', 'label' => 'Editar Perfil'],
            ['module_id' => 1, 'name' => 'roles.delete', 'label' => 'Deletar Perfil'],
            ['module_id' => 1, 'name' => 'permissions.index', 'label' => 'Listar Permissões'],
            ['module_id' => 1, 'name' => 'permissions.create', 'label' => 'Cadastrar Permissão'],
            ['module_id' => 1, 'name' => 'permissions.edit', 'label' => 'Editar Permissão'],
            ['module_id' => 1, 'name' => 'permissions.delete', 'label' => 'Deletar Permissão'],
            ['module_id' => 1, 'name' => 'menu.index', 'label' => 'Listar Menus'],
            ['module_id' => 1, 'name' => 'menu.create', 'label' => 'Cadastrar Menu'],
            ['module_id' => 1, 'name' => 'menu.edit', 'label' => 'Editar Menu'],
            ['module_id' => 1, 'name' => 'menu.delete', 'label' => 'Deletar Menu'],

            ['module_id' => 2, 'name' => 'site.logo.index', 'label' => 'Listar Logotipo'],
            ['module_id' => 2, 'name' => 'site.logo.create', 'label' => 'Cadastrar Logotipo'],
            ['module_id' => 2, 'name' => 'site.logo.edit', 'label' => 'Editar Logotipo'],
            ['module_id' => 2, 'name' => 'site.logo.delete', 'label' => 'Deletar Logo'],
            ['module_id' => 2, 'name' => 'site.maintext.index', 'label' => 'Listar Texto Principal'],
            ['module_id' => 2, 'name' => 'site.maintext.create', 'label' => 'Cadastrar Texto Principal'],
            ['module_id' => 2, 'name' => 'site.maintext.edit', 'label' => 'Editar Texto Principal'],
            ['module_id' => 2, 'name' => 'site.maintext.delete', 'label' => 'Deletar Texto Principal'],
            ['module_id' => 2, 'name' => 'site.carousel.index', 'label' => 'Listar Carousel'],
            ['module_id' => 2, 'name' => 'site.carousel.create', 'label' => 'Cadastrar Carousel'],
            ['module_id' => 2, 'name' => 'site.carousel.edit', 'label' => 'Editar Carousel'],
            ['module_id' => 2, 'name' => 'site.carousel.delete', 'label' => 'Deletar Carousel'],
            ['module_id' => 2, 'name' => 'site.about.index', 'label' => 'Listar Sobre'],
            ['module_id' => 2, 'name' => 'site.about.create', 'label' => 'Cadastrar Sobre'],
            ['module_id' => 2, 'name' => 'site.about.edit', 'label' => 'Editar Sobre'],
            ['module_id' => 2, 'name' => 'site.about.delete', 'label' => 'Deletar Sobre'],
            ['module_id' => 2, 'name' => 'site.contact.index', 'label' => 'Listar Contato'],
            ['module_id' => 2, 'name' => 'site.contact.create', 'label' => 'Cadastrar Contato'],
            ['module_id' => 2, 'name' => 'site.contact.edit', 'label' => 'Editar Contato'],
            ['module_id' => 2, 'name' => 'site.contact.delete', 'label' => 'Deletar Contato'],
            ['module_id' => 2, 'name' => 'site.socialmedia.index', 'label' => 'Listar Mídias Sociais'],
            ['module_id' => 2, 'name' => 'site.socialmedia.create', 'label' => 'Cadastrar Mídias Sociais'],
            ['module_id' => 2, 'name' => 'site.socialmedia.edit', 'label' => 'Editar Mídias Sociais'],
            ['module_id' => 2, 'name' => 'site.socialmedia.delete', 'label' => 'Deletar Mídias Sociais'],

            ['module_id' => 3, 'name' => 'blog.index', 'label' => 'Listar Blog'],
            ['module_id' => 3, 'name' => 'blog.create', 'label' => 'Cadastrar Blog'],
            ['module_id' => 3, 'name' => 'blog.edit', 'label' => 'Editar Blog'],
            ['module_id' => 3, 'name' => 'blog.delete', 'label' => 'Deletar Blog'],
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->insert([
                'module_id' => $permission['module_id'],
                'name' => $permission['name'],
                'label' => $permission['label'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
