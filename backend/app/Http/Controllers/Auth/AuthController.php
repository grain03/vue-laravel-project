<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Responses\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $request->validated();

        try {
            $user = User::create([
                'f_name' => $request->f_name,
                'l_name' => $request->l_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $token = $user->createToken('auth_token')->plainTextToken;
            return ApiResponse::success(["token" => $token]);
        } catch(\Exception $e){
            Log::error('Error Message:', [
                'message' => $e->getMessage(),
            ]);
            return ApiResponse::error();
        }

    }

    public function login(LoginRequest $request)
    {
        $request->validated();

        try {
            $user = User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return ApiResponse::error(null,422,['message' => 'The provided credentials are incorrect.']);
            }
            $token = $user->createToken('auth_token')->plainTextToken;
            return ApiResponse::success(["token" => $token]);
        } catch(\Exception $e){
            Log::error('Error Message:', [
                'message' => $e->getMessage(),
            ]);
            return ApiResponse::error();
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();
            return ApiResponse::success(["message" => "logged out successfully"]);
        } catch(\Exception $e){
            Log::error('Error Message:', [
                'message' => $e->getMessage(),
            ]);
            return ApiResponse::error();
        }
    }
}
