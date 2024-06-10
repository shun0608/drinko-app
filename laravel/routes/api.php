<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\User;

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
  Route::get('/user', function (Request $request) {
    $user = $request->user();
    \Log::info($user);
    return $user;
  });
  Route::post('/posts', function (Request $request) {
    $users = User::all();
    return response()->json(compact('users'), 200);
  });
});

// Route::group(['middleware' => 'sanctum:guest'], function () {
//   // 未認証ユーザー向けのルートをここに追加
//   Route::get('/guest', function () {
//     return response()->json(['message' => 'This is a guest route']);
//   });
// });
