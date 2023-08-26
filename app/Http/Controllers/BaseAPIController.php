<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseAPIController extends Controller
{
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
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], $statusCode);
    }
}
