<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FetchDrinkDetailsFromApi extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'app:fetch-drink-details-from-api';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Fetch detailed drink recipes based on drinks_id from TheCocktailDB API';

  /**
   * Execute the console command.
   */
  public function handle()
  {
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
