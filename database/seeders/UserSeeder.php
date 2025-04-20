<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'type' => 1,
                'password' => bcrypt('123456'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Manager',
                'email' => 'manager@mail.com',
                'type' => 2,
                'password' => bcrypt('123456'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'User',
                'email' => 'user@mail.com',
                'type' => 0,
                'password' => bcrypt('123456'),
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
