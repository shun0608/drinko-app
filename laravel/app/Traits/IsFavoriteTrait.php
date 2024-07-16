<?php

namespace App\Traits;

use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

trait IsFavoriteTrait
{
    /**
     * Check if a drink is in the user's favorites.
     */
    public function isFavorite(int $drinkId): bool
    {
        return Favorite::where('drink_id', $drinkId)
            ->where('user_id', Auth::id())
            ->exists();
    }
}
