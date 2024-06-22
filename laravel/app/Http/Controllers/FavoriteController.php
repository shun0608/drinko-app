<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Drink;
use App\Models\Favorite;

class FavoriteController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $user = Auth::user();
    if ($user) {
      $userId = $user->id;
      $userFavorites = Faborite::where('user_id', $userId)->pluck('drink_id');
      if ($userFavorites) {
        $drinks = Drink::whereIn('id', $userFavorites);
        return response()->json(compact('drinks', 200));
      } else {
        return response()->json(['error' => 'お気に入りしたドリンクがありません'], 404);
      }
    } else {
      return respnse()->json(['error' => 'Unauthorized'], 401);
    }
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
  public function store($userId, $drinkId)
  {
    $favorite = new Favorite;
    $favorite->user_id = $userId;
    $favorite->drink_id = $drinkId;
    $favorite->save();
    return response()->json(['message' => 'お気に入りに登録されました。'], 201);
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($userId, $drinkId)
  {
    Favorite::where('user_id', $userId)->where('drink_id', $drinkId)->delete();
    return response()->json(['message' => 'お気に入りから削除されました'], 200);
  }

  public function isFavorite($drinkId, $userId = null)
  {
    $userId =  $userId ?? Auth::id();
    if (!$userId) {
      return response()->json(['error' => 'Unauthorized'], 401);
    }
    return Favorite::where('user_id', $userId)->where('drink_id', $drinkId)->exists();
  }

  public function toggleFavorite($drinkId)
  {
    $user = Auth::user();
    if (isset($user)) {
      $userId = $user->id;
      if ($this->isFavorite($userId, $drinkId)) {
        return $this->destroy($userId, $drinkId);
      } else if (!($this->isFavorite($userId, $drinkId))) {
        return $this->store($userId, $drinkId);
      }
    } else {
      return response()->json(['error' => 'Unauthorized'], 401);
    }
  }
}
