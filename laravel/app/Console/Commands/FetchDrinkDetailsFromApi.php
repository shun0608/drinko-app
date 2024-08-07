<?php

namespace App\Console\Commands;

use App\Models\Drink;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchDrinkDetailsFromApi extends Command
{
    protected $signature = 'app:fetch-drink-details-from-api';

    protected $description = 'Fetch detailed drink recipes based on drinks_id from TheCocktailDB API';

    /** 補足
     * TheCocktailDB APIの仕様で以下の手順でドリンク情報を取得する必要があります。
     * 1. ノンアルコールドリンクのID一覧を取得
     * 2. 取得したIDからドリンクの詳細情報を取得
     * 3. 取得した詳細情報を翻訳
     * ここでは、2.を実行しています。
     *  */
    public function handle()
    {
        $drinks = Drink::select('cocktailDB_id')->get();
        $drink_details_url = 'https://www.thecocktaildb.com/api/json/v1/1/lookup.php?i=';

        foreach ($drinks as $drink) {
            $fetchedDrinkDetails = Http::get($drink_details_url.$drink['cocktailDB_id']);

            if ($fetchedDrinkDetails->failed()) {
                $this->error('Request failed: '.$fetchedDrinkDetails->body());

                return 0;
            }

            $fetchedDrinkDetails = json_decode($fetchedDrinkDetails, true);
            $drink_details = $fetchedDrinkDetails['drinks'][0];
            $drink = Drink::where('cocktailDB_id', $drink['cocktailDB_id'])->first();
            $drink->recipe_en = $drink_details['strInstructions'];
            // TheCocktailDB APIのデータがingredient及びmeasureについては、1~15まで用意されていたため15まで取得
            for ($i = 1; $i <= 15; $i++) {
                $ingredient_property = 'ingredient_en'.$i;
                $measure_property = 'measure_en'.$i;
                $drink->$ingredient_property = $drink_details['strIngredient'.$i];
                $drink->$measure_property = $drink_details['strMeasure'.$i];
            }
            $drink->save();
        }

        return 1;
    }
}
