<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesTablesSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'role' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => 'Writter',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => 'User',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
