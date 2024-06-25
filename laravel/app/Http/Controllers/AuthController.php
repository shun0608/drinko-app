<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\User\AuthRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
  public function login(AuthRequest $request)
  {
    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);

    $user = User::where('email', $credentials['email'])
      ->whereNull('deleted_at')
      ->first();

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();
      Auth::login($user);
      return response()->json(['message' => 'ログインしました。']);
    }
    return response()->json(['message' => 'ログインできませんでした。メールアドレスまたはパスワードが異なります。'], 401);
  }

  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();
    return response()->json(['message' => 'ログアウト成功']);
  }
}
