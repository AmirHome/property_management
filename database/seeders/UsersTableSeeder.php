<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@propertymanagement.com',
                'password'       => bcrypt('password@10203040!'),
                'remember_token' => null,
                'phone'          => '',
            ],
            [
                'id'             => 2,
                'name'           => 'Building Manager Test',
                'email'          => 'manager@propertymanagement.com',
                'password'       => bcrypt('password@10203040!'),
                'remember_token' => null,
                'phone'          => '',
            ],
            [
                'id'             => 3,
                'name'           => 'Landlord Test',
                'email'          => 'landlord@propertymanagement.com',
                'password'       => bcrypt('password@10203040!'),
                'remember_token' => null,
                'phone'          => '',
            ],
            [
                'id'             => 4,
                'name'           => 'Tenant Test',
                'email'          => 'tenant@propertymanagement.com',
                'password'       => bcrypt('password@10203040!'),
                'remember_token' => null,
                'phone'          => '',
            ]

        ];

        User::insert($users);
    }
}
