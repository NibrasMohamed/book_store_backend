<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseAPIController;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class RoleController extends BaseAPIController
{
    public function getRoles(){
        try {
            $repository = new UserRepository;

            $data = $repository->getRoles();

            return $this->successResponse($data, 'success', 200);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), $ex->getCode());
        }
    }
}
