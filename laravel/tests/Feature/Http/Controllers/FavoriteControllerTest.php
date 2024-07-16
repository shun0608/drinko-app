<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Drink;
use App\Models\Favorite;

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
        $user_id = $user->id;
        $url = 'api/mypage/' . $user_id;

        $response = $this->actingAs($user)->get($url);

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
            ]
        ]);
    }
}
