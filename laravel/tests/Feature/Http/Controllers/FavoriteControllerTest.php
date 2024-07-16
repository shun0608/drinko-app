<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Drink;
use App\Models\Favorite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FavoriteControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_user_favorite_drinks(): void
    {
        $drinks = Drink::factory(5)->create();
        $favorites = Favorite::factory(2)->create();

        $user = $favorites->first()->user;

        $response = $this->actingAs($user)->get('api/mypage/');

        $userFavorites = Favorite::where('user_id', $user->id)->pluck('drink_id');

        $this->assertTrue($userFavorites->isNotEmpty());

        $this->assertCount(1, $userFavorites);

        $drinks = Drink::whereIn('id', $userFavorites)->get();

        $response->assertStatus(200);

        $response->assertJsonCount(1);

        $response->assertJson([
            [
                'id' => $drinks->first()->id,
                'name_en' => $drinks->first()->name_en,
            ],
        ]);
    }
}
