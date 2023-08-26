<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    public function registerUser(array $userData)
    {
        // Create a new user and store in the database
        $user = User::create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' =>  bcrypt($userData['password']),
        ]);

        if (isset($userData['role'])) {
            $role = Role::where('name', $userData['role'])->first();
        }else{
            $role = Role::where('name', 'visitor')->first();
        }

        $user->roles()->attach($role);


        return $user;
    }

    public function userLogin($email, $password){
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Authentication successful
            $user = Auth::user();
            $token = $user->createToken('PasswordLogin')->accessToken;
    
            return ['token' => $token];
        }
    
        // Authentication failed
        return ['error' => 'Unauthorized'];
    }
}
