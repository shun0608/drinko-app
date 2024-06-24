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
      $userFavorites = Favorite::where('user_id', $userId)->pluck('drink_id');
      if ($userFavorites->isNotEmpty()) {
        $drinks = Drink::whereIn('id', $userFavorites)->get();
        return response()->json($drinks);
      } else {
        return response()->json(['error' => 'お気に入りに追加したドリンクがありません'], 404);
      }
    } else {
      return response()->json(['error' => 'Unauthorized'], 401);
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
  public function store($drinkId, $userId)
  {
    $favorite = new Favorite;
    $favorite->drink_id = $drinkId;
    $favorite->user_id = $userId;
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
  public function destroy($drinkId, $userId)
  {
    Favorite::where('drink_id', $drinkId)->where('user_id', $userId)->delete();
    return response()->json(['message' => 'お気に入りから削除されました'], 200);
  }

  public function isFavorite($drinkId, $userId = null)
  {
    $userId =  $userId ?? Auth::id();
    return Favorite::where('drink_id', $drinkId)->where('user_id', $userId)->exists();
  }

  public function toggleFavorite($drinkId)
  {
    $user = Auth::user();
    if (isset($user)) {
      $userId = $user->id;
      $isFavorite = $this->isFavorite($drinkId, $userId);
      if ($isFavorite) {
        return $this->destroy($drinkId, $userId);
      } else if (!$isFavorite) {
        return $this->store($drinkId, $userId);
      } else {
        return response()->json(['error' => 'お気入り登録時にエラーが発生しました。'], 401);
      }
    } else {
      return response()->json(['error' => 'Unauthorized'], 401);
    }
  }
}
