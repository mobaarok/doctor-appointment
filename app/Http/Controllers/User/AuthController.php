<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use App\Model\User;
use App\Repositories\UserRepository;

class AuthController extends Controller
{

    public function register(UserRegisterRequest $request, UserRepository $userRepository)
    {
      $user = $userRepository->create($request);
      // return response()->json(['user' => $user], 201);
      $token = auth()->login($user);
      return $this->respondWithToken($token);
    }

    public function login(UserLoginRequest $request)
    {
      $credentials = $request->only(['email', 'password']);
      if (!$token = auth()->attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
      }
      return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message'=>'Successfully logged out']);
    }

    public function getAuthUser(Request $request)
    {
        return response()->json(auth()->user());
    }

    /*
    ** Response Function
    */
    protected function respondWithToken($token)
    {
      return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth()->factory()->getTTL() * 60
      ]);

    }

}
