<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\AuthRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Handle a login request to the application.
     */
    public function login(AuthRequest $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])
            ->whereNull('deleted_at')
            ->first();

        if ($user && Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json(['message' => 'ログインしました。']);
        }

        return response()->json(['message' => 'ログインできませんでした。メールアドレスまたはパスワードが異なります。'], 401);
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request): JsonResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(['message' => 'ログアウト成功']);
    }
}
