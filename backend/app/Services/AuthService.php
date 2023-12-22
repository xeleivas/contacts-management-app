<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthService
{

    /**
     * This service doesn't includes try catch blocks due to the exceptions handling being done in the controller.
     * This is due to the simplicity of the project, and to avoid unnecessary and/or duplicated code.
     */

    /**
     * This function handles the login process.
     *
     * @param array $credentials User's credentials (email and password)
     * @return \Illuminate\Http\JsonResponse
     */
    public function login($credentials)
    {
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = User::where('email', $credentials['email'])->first();

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('authToken')->plainTextToken,
            'message' => 'Successfully logged in',
        ], 200);
    }

    /**
     * Logout The User
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}
