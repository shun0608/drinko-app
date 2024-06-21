<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;
use App\Models\Drink;

class FetchDrinkDetailsFromApi extends Command
{
  protected $signature = 'app:fetch-drink-details-from-api';

  protected $description = 'Fetch detailed drink recipes based on drinks_id from TheCocktailDB API';

  public function handle()
  {
    $drinks = Drink::select('cocktailDB_id')->get();
    $drink_details_url = 'https://www.thecocktaildb.com/api/json/v1/1/lookup.php?i=';

    foreach ($drinks as $drink) {
      try {
        $fetchedDrinkDetails = Http::get($drink_details_url . $drink['cocktailDB_id']);
      } catch (ClientException $e) {
        echo Psr7\Message::toString($e->getRequest());
        echo Psr7\Message::toString($e->getResponse());
      }
      $fetchedDrinkDetails = json_decode($fetchedDrinkDetails, true);
      $drink_details = $fetchedDrinkDetails['drinks'][0];
      $drink = Drink::where('cocktailDB_id', $drink['cocktailDB_id'])->first();
      $drink->recipe_en = $drink_details['strInstructions'];
      for ($i = 1; $i <= 15; $i++) {
        $ingredient_property = 'ingredient_en' . $i;
        $measure_property = 'measure_en' . $i;
        $drink->$ingredient_property = $drink_details['strIngredient' . $i];
        $drink->$measure_property = $drink_details['strMeasure' . $i];
      }
      $drink->save();
    }
  }
}
