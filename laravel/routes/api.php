<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\FavoriteController;
use App\Models\User;

Route::controller(AuthController::class)->group(function () {
  Route::post('/login', 'login');
  Route::post('/logout', 'logout');
});

Route::controller(DrinkController::class)->group(function () {
  Route::get('/drinks', 'index');
  Route::get('/drinks/{id}', 'show');
});

Route::middleware('auth:sanctum')->group(function () {
  Route::get('/user', function (Request $request) {
    $user = $request->user();
    \Log::info($user);
    return $user;
  });
  Route::post('/favorite/{drinkId}', [FavoriteController::class, 'store']);
  Route::delete('/unfavorite/{drinkId}', [FavoriteController::class, 'destroy']);
});

Route::post('/register', [UsersController::class, 'store']);
