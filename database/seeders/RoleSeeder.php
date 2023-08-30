<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert admin role
        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'admin',
            'display_name' => 'Admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert author role
        DB::table('roles')->insert([
            'id' => 2,
            'name' => 'author',
            'display_name' => 'Author',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert visitor role
        DB::table('roles')->insert([
            'id' => 3,
            'name' => 'visitor',
            'display_name' => 'Visitor',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
