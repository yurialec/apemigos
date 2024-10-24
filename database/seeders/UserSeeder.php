<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Dev',
            'email' => 'dev@dev.com',
            'password' => bcrypt('123456'),
            'role_id' => 1,
        ]);

        User::factory()->count(5)->create();
    }
}
