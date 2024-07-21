<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Menu::create([
            'name' => 'Dashboard',
            'url' => 'dashboard',
            'sequence' => 1,
        ]);
        Menu::create([
            'name' => 'Menu',
            'url' => 'menu.index',
            'sequence' => 2,
        ]);
        Menu::create([
            'name' => 'Role',
            'url' => 'role.index',
            'sequence' => 3,
        ]);
        Menu::create([
            'name' => 'User',
            'url' => 'user.index',
            'sequence' => 4,
        ]);

        Role::create([
            'name' => 'Superuser',
        ]);
        Role::create([
            'name' => 'Admin',
        ]);
        Role::create([
            'name' => 'User',
        ]);

        User::create([
            'name' => 'Superuser',
            'role_id' => 1,
            'email' => 'superuser@test.com',
            'password' => Hash::make('superuser@test.com'),
        ]);
        User::create([
            'name' => 'Admin',
            'role_id' => 2,
            'email' => 'admin@test.com',
            'password' => Hash::make('admin@test.com'),
        ]);
        User::create([
            'name' => 'User',
            'role_id' => 3,
            'email' => 'user@test.com',
            'password' => Hash::make('user@test.com'),
        ]);
    }
}
