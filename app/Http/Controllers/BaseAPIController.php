<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BaseAPIController extends Controller
{
    
    protected $validStatusCodes = [
        Response::HTTP_OK,             
        Response::HTTP_CREATED,         
        Response::HTTP_ACCEPTED,        
        Response::HTTP_NO_CONTENT,      
        Response::HTTP_MOVED_PERMANENTLY, 
        Response::HTTP_FOUND,           
        Response::HTTP_BAD_REQUEST,     
        Response::HTTP_UNAUTHORIZED,    
        Response::HTTP_FORBIDDEN,       
        Response::HTTP_NOT_FOUND,       
        Response::HTTP_METHOD_NOT_ALLOWED, 
        Response::HTTP_UNPROCESSABLE_ENTITY, 
        Response::HTTP_INTERNAL_SERVER_ERROR, 
        Response::HTTP_SERVICE_UNAVAILABLE, 
        Response::HTTP_TOO_MANY_REQUESTS, 
        Response::HTTP_NOT_MODIFIED,
    ];

    protected function successResponse($data = [], $message = 'Success', $statusCode = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    protected function errorResponse($message, $statusCode)
    {
        $statusCode = $this->isValidStatusCode($statusCode)?$statusCode:500;
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], $statusCode);
    }

    protected function isValidStatusCode($statusCode)
    {
        return in_array($statusCode, $this->validStatusCodes);
    }
}
