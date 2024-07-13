<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Http;

use App\Models\Drink;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

class FetchNonAlcoholicDrinksFromApi extends Command
{
    protected $signature = 'app:fetch-non-alcoholic-drinks-from-api';

    protected $description = 'Fetch non alcoholic drink data from TheCocktailDB';

    public function handle()
    {
        $non_alcoholic_response = Http::get('https://www.thecocktaildb.com/api/json/v1/1/filter.php?a=Non_Alcoholic');

        if ($non_alcoholic_response->failed()) {
            $this->error('Request failed: ' . $non_alcoholic_response->body());
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
