<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert the user
        $email = $this->command->ask('Please enter the admin email');
        $password = $this->command->ask('Please enter the admin password');

        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Admin',
            'email' => $email,
            'email_verified_at' => null,
            'password' => bcrypt($password),
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Assign the role to the user
        DB::table('role_user')->insert([
            'user_id' => 1, // The ID of the user just inserted
            'role_id' => 1, // The ID of the 'admin' role
        ]);
    }
}
