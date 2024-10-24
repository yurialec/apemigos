<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'name' => 'Desenvolvedor',
        ]);

        DB::table('roles')->insert([
            'name' => 'Admin',
        ]);

        DB::table('roles')->insert([
            'name' => 'Auxiliar Adm',
        ]);

        DB::table('roles')->insert([
            'name' => 'Médico',
        ]);

        DB::table('roles')->insert([
            'name' => 'Paciente',
        ]);
    }
}
