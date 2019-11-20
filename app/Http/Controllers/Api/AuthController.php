<?php
 
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller; 
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
 
class AuthController extends Controller
{
 
 
    public function login(AuthRequest $request)
    {
        $input = $request->only('email', 'password');
        $jwtToken = null;
 
        if (!$jwtToken = JWTAuth::attempt($input)) {
            return response()->json([
                'message' => 'Invalid Email or Password',
            ],400);
        }
 
        return response()->json([
            'token' => $jwtToken,
        ]);
    }
 
    public function logout(AuthRequest $request)
    {
        try {
            JWTAuth::invalidate($request->token);
            return response()->json([
                'message' => 'User logged out successfully'
            ],401);
        } catch (JWTException $exception) {
            return response()->json([
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }
 
 
}