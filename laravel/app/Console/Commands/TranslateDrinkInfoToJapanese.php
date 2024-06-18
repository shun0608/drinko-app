<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Stichoza\GoogleTranslate\GoogleTranslate;

use App\Models\Drink;

class TranslateDrinkInfoToJapanese extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'app:translate-drink-info-to-japanese';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Translate drink information from English to Japanese';

  /**
   * Execute the console command.
   */
  public function handle()
  {
    $tr = new GoogleTranslate('ja'); // Translates into Japanese
    $drink_ids = Drink::select('drink_id')->get();

    foreach ($drink_ids as $drink_id) {
      $drink = Drink::where('drink_id', $drink_id['drink_id'])->first();
      $drink->name_ja = $tr->translate($drink->name_en);
      for ($i = 1; $i <= 15; $i++) {
        $ingredient_property_ja = 'ingredient_ja' . $i;
        $ingredient_property_en = 'ingredient_en' . $i;
        $measure_property_ja = 'measure_ja' . $i;
        $measure_property_en = 'measure_en' . $i;
        if ($drink->$ingredient_property_en) {
          $drink->$ingredient_property_ja = $tr->translate($drink->$ingredient_property_en);
        }
        if ($drink->$measure_property_en) {
          $drink->$measure_property_ja = $tr->translate($drink->$measure_property_en);
        }
      }
      $drink->recipe_ja = $tr->translate($drink->recipe_en);
      $drink->save();
    }
  }
}
