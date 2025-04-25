<?php

namespace Database\Seeders;

use App\Models\User;
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

        $adminUsers = [
            [
                'name' => 'Admin1',
                'email' => 'admin@levant.com',
                'password' => 'password',
            ],
            [
                'name' => 'Takwa Admin2',
                'email' => 'takwa.alnassouh@expentech.com',
                'password' => 'password',
            ],
        ];

        $normalUsers = [
            [
                'name' => 'Normal User 1',
                'email' => 'user@levant.com',
                'password' => 'password',
            ],
            [
                'name' => 'Takwa Alnassouh',
                'email' => 'takwasyr81@gmail.com',
                'password' => 'password',
            ],
            [
                'name' => 'Rawan Alahmar',
                'email' => 'rawanalahmar@gmail.com',
                'password' => 'password',
            ],
            [
                'name' => 'Admin User 2',
                'email' => 'takwamuhamad69@gmail.com',
                'password' => 'password',
            ],
        ];

        foreach ($adminUsers as $adminData) {
            $admin = User::firstOrCreate(
                ['email' => $adminData['email']],
                [
                    'name' => $adminData['name'],
                    'password' => Hash::make($adminData['password']),
                    'image' => 'default.png',
                ]
            );

            $admin->assignRole($adminRole);
        }

        foreach ($normalUsers as $userData) {
            User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make($userData['password']),
                    'image' => 'default.png',
                ]
            );
        }
    }
}
