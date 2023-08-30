<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\RegisterUserRequest;
use App\Http\Controllers\BaseAPIController;
use App\Http\Requests\API\UserLoginRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class AuthenticationController extends BaseAPIController
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterUserRequest $request){

        try {
            $user = $this->userRepository->registerUser([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'role' => $request->input('role', null),
            ]);

            return $this->successResponse($user, 'User Successfully Registered', 200);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), $ex->getCode());
        }
        
    }

    public function login(UserLoginRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $response = $this->userRepository->userLogin($email, $password);

        if (isset($response['error'])) {
           return $this->errorResponse($response, 401); // Unauthorized
        }

        return $this->successResponse($response); // Successful login with token
    }

    public function logout(Request $request)
    {

        $response = $this->userRepository->userLogout($request->user());

        if (isset($response['error'])) {
           return $this->errorResponse($response, 401); // Unauthorized
        }

        return $this->successResponse(null, 'Succesfully Logged Out'); // Successful Logout
    }
}
