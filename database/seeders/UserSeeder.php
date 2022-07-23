<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
              'name' => 'admin',
              'email' => 'admin@admin.com',
              'password' => Hash::make('123456789'),
              'role_id' => 1 // user role
            ],
            [
              'name' => 'provider',
              'email' => 'provider@provider.com',
              'password' => Hash::make('123456789'),
              'role_id' => 2 // user role
            ],
            [
              'name' => 'user',
              'email' => 'user@user.com',
              'password' => Hash::make('123456789'),
              'role_id' => 3 // user role
            ],
            [
              'name' => 'ahmed',
              'email' => 'ahmed@user.com',
              'password' => Hash::make('123456789'),
              'role_id' => 3 // user role
            ]
        ];

        User::insert($users);
    }
}