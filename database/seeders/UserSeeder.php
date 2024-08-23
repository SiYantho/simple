<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::all()->keyBy('name');

        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'), // Use a more secure password in a real application
                'role_id' => $roles['admin']->id,
            ],
            [
                'name' => 'User 1',
                'username' => 'user1',
                'email' => 'user1@example.com',
                'password' => Hash::make('password'), // Use a more secure password in a real application
                'role_id' => $roles['user1']->id,
            ],
            [
                'name' => 'User 2',
                'username' => 'user2',
                'email' => 'user2@example.com',
                'password' => Hash::make('password'), // Use a more secure password in a real application
                'role_id' => $roles['user2']->id,
            ],
        ]);
    }
}
