<?php

namespace App\Responses;

class ApiResponse
{
    public static function success($data = null, $message = 'Operation successful', $statusCode = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    public static function error($message = 'We can\'t handle this request at this moment!', $statusCode = 500, $errors = null)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors
        ], $statusCode);
    }
}
