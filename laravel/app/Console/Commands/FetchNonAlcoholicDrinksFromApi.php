<?php

namespace App\Console\Commands;

use App\Models\Drink;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchNonAlcoholicDrinksFromApi extends Command
{
    protected $signature = 'app:fetch-non-alcoholic-drinks-from-api';

    protected $description = 'Fetch non alcoholic drink data from TheCocktailDB';

    /** 補足
     * TheCocktailDB APIの仕様で以下の手順でドリンク情報を取得する必要があります。
     * 1. ノンアルコールドリンクのID一覧を取得
     * 2. 取得したIDからドリンクの詳細情報を取得
     * 3. 取得した詳細情報を翻訳
     * ここでは、1.を実行しています。
     *  */
    public function handle()
    {
        $non_alcoholic_response = Http::get('https://www.thecocktaildb.com/api/json/v1/1/filter.php?a=Non_Alcoholic');

        if ($non_alcoholic_response->failed()) {
            $this->error('Request failed: '.$non_alcoholic_response->body());

            return 0;
        }

        $data = $non_alcoholic_response;
        $data = json_decode($data, true);

        foreach ($data['drinks'] as $drink_element) {
            $drink = new Drink();
            $drink->cocktailDB_id = $drink_element['idDrink'];
            $drink->name_en = $drink_element['strDrink'];
            $drink->image_url = $drink_element['strDrinkThumb'];
            $drink->save();
        }

        return 1;
    }
}
