<?php

namespace Database\Seeders;

use App\Models\Admin\Modules;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Modules::insert([
            'name' => 'Admin',
        ]);
        Modules::insert([
            'name' => 'Site',
        ]);
        Modules::insert([
            'name' => 'Blog',
        ]);
    }
}
