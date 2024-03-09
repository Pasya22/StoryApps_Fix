<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id_role' => 1,
                'email' => 'admin@gmail.com',
                'username' => 'admin',
                'full_name' => 'Admin Story Apps',
                'image_user' => 'default.png',
                'phone_number' => '089602648625',
                'password' => Hash::make('123123123'),
            ],
            [
                'id_role' => 2,
                'email' => 'pasya@gmail.com',
                'username' => 'Pasya',
                'full_name' => 'Pasya',
                'image_user' => 'default.png',
                'phone_number' => '089602648625',
                'password' => Hash::make('123123123'),
            ],

        ]);

        
    }
}
