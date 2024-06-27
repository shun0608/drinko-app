<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Drink;
use App\Models\Favorite;

class FavoriteController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return JsonResponse
   */
  public function index(): JsonResponse
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
   *
   * @param int $drinkId
   * @param int $userId
   * @return JsonResponse
   */
  public function store(int $drinkId, int $userId): JsonResponse
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
   *
   * @param int $drinkId
   * @param int $userId
   * @return JsonResponse
   */
  public function destroy(int $drinkId, int $userId): JsonResponse
  {
    Favorite::where('drink_id', $drinkId)->where('user_id', $userId)->delete();

    return response()->json(['message' => 'お気に入りから削除されました'], 200);
  }

  /**
   * Check if a drink is in the user's favorites.
   *
   * @param int $drinkId
   * @param int|null $userId
   * @return bool
   */
  public function isFavorite(int $drinkId, int $userId = null): bool
  {
    $userId =  $userId ?? Auth::id();

    return Favorite::where('drink_id', $drinkId)->where('user_id', $userId)->exists();
  }

  /**
   * Toggle the favorite status of a drink.
   *
   * @param int $drinkId
   * @return collable|JsonResponse
   */
  public function toggleFavorite(int $drinkId): collable|JsonResponse
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
      return response()->json(['error' => 'お気に入り機能をご利用いただくには、ログインが必要です。'], 401);
    }
  }
}
