<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin 1',
                'email' => 'admin1@gmail.com',
                'password' => Hash::make('password'),
                'type' => 1,
            ],
            [
                'name' => 'Admin 2',
                'email' => 'admin2@gmail.com',
                'password' => Hash::make('password'),
                'type' => 1,
            ],
            [
                'name' => 'John',
                'email' => 'john@gmail.com',
                'password' => Hash::make('password'),
                'type' => 0,
            ],
            [
                'name' => 'Sam',
                'email' => 'sam@gmail.com',
                'password' => Hash::make('password'),
                'type' => 0,
            ],
        ];

        // Truncate Table
        DB::table('users')->truncate();

        foreach($users as $user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
                'type' => $user['type'],
            ]);
        }
    }
}
