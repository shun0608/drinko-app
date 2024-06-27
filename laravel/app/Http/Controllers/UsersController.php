<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\User\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  public function store(UserRequest $request)
  {
    $old_user = User::withTrashed()->where('email', $request->email)->first();

    if ($old_user) {
      $old_user->forceDelete();
    }

    $new_user = User::create([
      'name' =>  $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    Auth::login($new_user);

    return response()->json(['created' => true], Response::HTTP_OK);
  }

  /**
   * Display the specified resource.
   */
  public function show(User $user)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(User $user)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, User $user)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request)
  {
    $user = Auth::user();
    if (!$user) {
      return response()->json('ユーザーが見つかりません。', 404);
    }
    $user->tokens()->delete();
    $request->session()->invalidate();
    $user->delete();
    return response()->json('ユーザーの削除が完了しました。');
  }
}
