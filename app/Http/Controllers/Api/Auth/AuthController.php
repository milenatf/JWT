<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;

use App\Models\User;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $token = auth()->attempt($request->all());

        if ($token) {
            return $this->respondWithToken($token, auth()->user());
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Login e/ou senha inválidos!'
            ], 401);
        }
    }

    /**
     * Registation Method
     *
     * @return void
     */
    public function register(RegistrationRequest $request)
    {
        $user = User::create($request->all());

        /**
         * Depois do usuário criado ele é registrado no token de acesso JWT
         */
        if($user) {
            $token = auth()->login($user); // Faz o login do usuário registrado e cria o token de acesso

            return $this->respondWithToken($token, $user);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Um erro ocorreu ao tentar criar o usuário'
            ], 500);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        // return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        // return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Method that returns the token when registering or logging in
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $user)
    {
        return response()->json([
            'status' => 'success',
            'access_token' => $token,
            'user' => $user,
            'token_type' => 'bearer'
        ]);
    }
}
