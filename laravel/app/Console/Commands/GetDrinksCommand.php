<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Http;

use App\Models\Drink;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;

class GetDrinksCommand extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'app:get-drinks-command';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Get drink data from TheCocktailDB';

  /**
   * Execute the console command.
   */
  public function handle()
  {
    // $non_alcohol_response = Http::get('https://www.thecocktaildb.com/api/json/v1/1/filter.php?a=Non_Alcoholic');

    // try {
    //   $data = $non_alcohol_response;
    // } catch (ClientException $e) {
    //   echo Psr7\Message::toString($e->getRequest());
    //   echo Psr7\Message::toString($e->getResponse());
    // }
    // if ($data) {
    //   $data = json_decode($data, true);
    // }

    // foreach ($data['drinks'] as $drink_element) {
    //   $drink = new Drink();
    //   $drink->drink_id = $drink_element['idDrink'];
    //   $drink->name_en = $drink_element['strDrink'];
    //   $drink->image_url = $drink_element['strDrinkThumb'];
    //   $drink->save();
    // }

    $drink_ids = Drink::select('drink_id')->get();
    $drink_detail_url = 'https://www.thecocktaildb.com/api/json/v1/1/lookup.php?i=';

    foreach ($drink_ids as $drink_id) {
      try {
        $detail_data = Http::get($drink_detail_url . $drink_id['drink_id']);
      } catch (ClientException $e) {
        echo Psr7\Message::toString($e->getRequest());
        echo Psr7\Message::toString($e->getResponse());
      }
      $detail_data = json_decode($detail_data, true);
      $drink_details = $detail_data['drinks'][0];
      $drink = Drink::where('drink_id', $drink_id['drink_id'])->first();
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
