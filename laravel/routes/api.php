<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DrinkController;
use App\Models\User;

Route::controller(AuthController::class)->group(function () {
  Route::post('/login', 'login');
  Route::post('/logout', 'logout');
});

Route::controller(DrinkController::class)->group(function () {
  Route::get('/drinks', 'index');
  Route::get('/drinks/{id}', 'show');
});

Route::get('/user', function (Request $request) {
  $user = $request->user();
  \Log::info($user);
  return $user;
})->middleware('auth:sanctum');

Route::post('/register', [UsersController::class, 'store']);
