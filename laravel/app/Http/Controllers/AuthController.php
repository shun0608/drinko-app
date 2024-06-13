<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\User\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function login(AuthRequest $request)
  {
    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();
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
