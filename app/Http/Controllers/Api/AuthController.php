<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Repositories\UserRepository;

class AuthController extends Controller
{
    private $userRepository;
    public function __construct(){
        $this->userRepository = new UserRepository();
    }

    public function register(RegisterRequest $request)
    {
        //create user
        $user = $this->userRepository->store($request);

        //return response JSON user is created
        if($user) {
            return response()->json([
                'success' => true,
                'user'    => $user,  
            ], 201);
        }

        //return JSON process insert failed 
        return response()->json([
            'success' => false,
            'message' => config('constants.failed_messages.insert')
        ], 409);
    }

    public function login(LoginRequest $request)
    {
        //get credentials from request
        $credentials = $request->only('email', 'password');

        //if auth failed
        if(!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => config('constants.failed_messages.login')
            ], 401);
        }

        //if auth success
        return response()->json([
            'success' => true,
            'user'    => auth()->user(),    
            'token'   => $token   
        ], 200);
    }

    public function logout(Request $request)
    {        
        //remove token
        $removeToken = JWTAuth::invalidate(JWTAuth::getToken());

        if($removeToken) {
            //return response JSON
            return response()->json([
                'success' => true,
                'message' => config('constants.success_messages.logout'),  
            ]);
        }
    }
}
