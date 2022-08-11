<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    /**
    * Run the database seeds.
    *
    * @return void
    */

    public function run() {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make( '123456789' ),
                'mobile' => '01099812536',
                'role_id' => 1, // admin role
                'image' => 'images/Usrimg/man.png',
                'lat' =>30.071265,
                'lng' =>31.021114,
            ],
            [
                'name' => 'provider',
                'email' => 'provider@provider.com',
                'password' => Hash::make( '123456789' ),
                'mobile' => '01553524888',
                'role_id' => 2, // provider role
                'image' => 'images/Usrimg/man.png',
                'lat' =>30.071265,
                'lng' =>31.021114,
            ],
            [
                'name' => 'user',
                'email' => 'user@user.com',
                'password' => Hash::make( '123456789' ),
                'mobile' => '01089812536',
                'role_id' => 3, // user role
                'image' => 'images/Usrimg/man.png',
                'lat' =>30.071265,
                'lng' =>31.021114,
            ],
            [
                'name' => 'ahmed',
                'email' => 'ahmed@user.com',
                'password' => Hash::make( '123456789' ),
                'mobile' => '01012345536',
                'role_id' => 3, // user role
                'image' => 'images/Usrimg/man.png',
                'lat' =>30.071265,
                'lng' =>31.021114,
            ]
        ];

        User::insert( $users );
    }
}
