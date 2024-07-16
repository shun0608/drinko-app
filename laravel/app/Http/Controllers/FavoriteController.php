<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use App\Models\Favorite;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\IsFavoriteTrait;

class FavoriteController extends Controller
{
    use IsFavoriteTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        if (Auth::user()) {
            $drinks = Drink::whereHas('favorites', function ($q) {
                $q->where('user_id', Auth::id());
            })->get();
            return response()->json($drinks);
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
    public function store(int $drinkId): JsonResponse
    {
        $favorite = new Favorite;
        $favorite->drink_id = $drinkId;
        $favorite->user_id = Auth::id();
        $favorite->save();

        // return response()->json(['message' => 'お気に入りに登録されました。'], 201);
        return response()->json(true, 201);
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
    public function destroy(int $drinkId): JsonResponse
    {
        Favorite::where('drink_id', $drinkId)->where('user_id', Auth::id())->delete();

        // return response()->json(['message' => 'お気に入りから削除されました'], 200);
        return response()->json(false, 200);
    }

    /**
     * Toggle the favorite status of a drink.
     */
    public function toggleFavorite(int $drinkId): callable|JsonResponse
    {
        if (Auth::user()) {
            $isFavorite = $this->isFavorite($drinkId);
            if ($isFavorite) {
                return $this->destroy($drinkId);
            } else {
                return $this->store($drinkId);
            }
        } else {
            return response()->json(['error' => 'お気に入り機能をご利用いただくには、ログインが必要です。'], 401);
        }
    }
}
