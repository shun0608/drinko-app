<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Models\User;

Route::controller(AuthController::class)->group(function () {
  Route::post('/login', 'login');
  Route::post('/logout', 'logout');
});
// Route::post('/login', [AuthController::class, 'login']);
// Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/user', function (Request $request) {
  $user = $request->user();
  \Log::info($user);
  return $user;
})->middleware('auth:sanctum');

Route::post('/register', [UsersController::class, 'store']);

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//   $user = $request->user();
//   \Log::info($user);
//   return $user;
// });

// Route::middleware(['auth:sanctum'])->group(function () {
//   Route::get('/user', function (Request $request) {
//     $user = $request->user();
//     \Log::info($user);
//     return $user;
//   });
//   Route::post('/posts', function (Request $request) {
//     $users = User::all();
//     return response()->json(compact('users'), 200);
//   });
// });

// Route::group(['middleware' => 'auth:sanctum'], function () {
//   Route::get('/user', function (Request $request) {
//     $user = $request->user();
//     \Log::info($user);
//     return $user;
//   });
//   Route::post('/posts', function (Request $request) {
//     $users = User::all();
//     return response()->json(compact('users'), 200);
//   });
// });

// Route::group(['middleware' => 'sanctum:guest'], function () {
//   // 未認証ユーザー向けのルートをここに追加
//   Route::get('/guest', function () {
//     return response()->json(['message' => 'This is a guest route']);
//   });
// });
