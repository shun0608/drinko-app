<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    try {
      // $userインスタンスを作成する
      $user = new User();

      // 投稿フォームから送信されたデータを取得し、インスタンスの属性に代入する
      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->password = $request->input('password');

      // データベースに保存
      $user->save();

      return back();
    } catch (\Exception $e) {
      // 下記については、要修正
      return redirect()->route('users.create')->with('message', '登録に失敗しました。' . $e->getMessage());
    }
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
  public function destroy(User $user)
  {
    //
  }
}
