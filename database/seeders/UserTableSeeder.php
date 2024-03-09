<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'email' => 'pasya@gmail.com',
                'username' => 'admin',
                'full_name' => 'Pasya',
                'phone_number' => '089602648625',
                'password' => Hash::make('123123123'),
            ],

        ]);
    }
}
