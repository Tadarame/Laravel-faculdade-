<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(AuthLoginRequest $request)
    {
        $username = $request->validated('username');
        $password = $request->validated('password');

        $user = User::firstWhere('email', $username);

        if ($user && Hash::check($password, $user->password)) {
            $token = $user->createToken($user->name);

            return [
                'token' => $token->plainTextToken,
                'user' => $user,
            ];
        }

        return response()->json([
            'message' => 'Credenciais inválidas',
        ], Response::HTTP_UNAUTHORIZED);
    }
}
