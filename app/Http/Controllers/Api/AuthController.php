<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create($request->all());

        if ($user) {
            return $this->responseSuccess($user, Response::HTTP_OK);
        }

        return $this->responseError('Create fail', Response::HTTP_BAD_REQUEST);
    }

    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return $this->responseError('Login fail', Response::HTTP_UNAUTHORIZED);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        $data = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];

        return $this->responseSuccess($data, Response::HTTP_OK);
    }
}
