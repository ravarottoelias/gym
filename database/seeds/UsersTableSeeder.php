<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create User
        User::create([
            'name' => 'Gymie',
            'email' => 'gymie@email.com',
            'password' => bcrypt('password'),
            'status' => '1',
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('password'),
            'status' => '1',
        ]);

        User::create([
            'name' => 'Manager',
            'email' => 'manager@email.com',
            'password' => bcrypt('password'),
            'status' => '1',
        ]);
    }
}
