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

        if ($user->roles->where('name', 'author')->count()>0) {
            $author = [
                'name' => $user->name,
                'user_id' => $user->id
            ];
            $authoRepository = new AuthorRepository;
            $author = $authoRepository->createAuthor($author);
            $user['author'] = $author;
        }
        $token = $user->createToken('auth_token')->accessToken;

        return ['user' => $user, 'token' => $token];
    }

    public function userLogin($email, $password){
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Authentication successful
            $user = Auth::user();
            $token = $user->createToken('auth_token')->accessToken;
            $user = auth()->user();
            
            return ['token' => $token, 'user' => $user, 'role' => $user->roles];
        }
    
        // Authentication failed
        return ['error' => 'Unauthorized'];
    }

    public function userLogout(User $user) : bool {
        $user->token()->revoke();
        return true;
    }
}
