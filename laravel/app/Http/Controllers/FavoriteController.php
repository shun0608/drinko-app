<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use App\Models\Favorite;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
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
     */
    public function destroy(int $drinkId, int $userId): JsonResponse
    {
        Favorite::where('drink_id', $drinkId)->where('user_id', $userId)->delete();

        return response()->json(['message' => 'お気に入りから削除されました'], 200);
    }

    /**
     * Check if a drink is in the user's favorites.
     */
    public function isFavorite(int $drinkId, ?int $userId = null): bool
    {
        $userId = $userId ?? Auth::id();

        return Favorite::where('drink_id', $drinkId)->where('user_id', $userId)->exists();
    }

    /**
     * Toggle the favorite status of a drink.
     */
    public function toggleFavorite(int $drinkId): callable|JsonResponse
    {
        $user = Auth::user();
        if (isset($user)) {
            $userId = $user->id;
            $isFavorite = $this->isFavorite($drinkId, $userId);
            if ($isFavorite) {
                return $this->destroy($drinkId, $userId);
            } else {
                return $this->store($drinkId, $userId);
            }
        } else {
            return response()->json(['error' => 'お気に入り機能をご利用いただくには、ログインが必要です。'], 401);
        }
    }
}
