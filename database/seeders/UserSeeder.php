<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);

        $admin = User::firstOrCreate(
            [
                'email' => 'admin@levant.com',
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'image' => 'default.png'
            ]
        );

        $admin->assignRole($adminRole);


        $userRole = Role::firstOrCreate(['name' => 'User']);

        $user = User::firstOrCreate(
            [
                'email' => 'user@levant.com',
                'name' => 'User',
                'password' => Hash::make('password'),
                'image' => 'default.png'
            ]
        );

        $user->assignRole($userRole);

    }
}
