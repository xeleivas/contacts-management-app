<?php

use App\Models\User;

class AuthService
{
    /**
     * This function handles the login process.
     *
     * @param array $credentials User's credentials (email and password)
     * @return \Illuminate\Http\JsonResponse
     */
    public function login($credentials)
    {
        try {
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
        } catch (Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Logout The User
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(User $request)
    {
        try {
            $request->user()->tokens()->delete();

            return response()->json(['message' => 'Successfully logged out'], 200);
        } catch (Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
