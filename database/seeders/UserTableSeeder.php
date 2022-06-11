<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users =  [
            [
                'name'  => 'John Dea',
                'email' => 'jhon@email.com',
                'password'  => Hash::make('123456789'),
                'remember_token' => null,
                'created_at'    => date('y-m-d h:i:s'),
                'updated_at'    => date('y-m-d h:i:s'),
            ],
            [
                'name'  => 'Jane Dea',
                'email' => 'jane@email.com',
                'password'  => Hash::make('123456789'),
                'remember_token' => null,
                'created_at'    => date('y-m-d h:i:s'),
                'updated_at'    => date('y-m-d h:i:s'),
            ]
        ];

        User::insert($users);
    }
}
