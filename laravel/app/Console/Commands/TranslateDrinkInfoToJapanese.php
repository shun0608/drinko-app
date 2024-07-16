<?php

namespace App\Console\Commands;

use App\Models\Drink;
use Illuminate\Console\Command;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateDrinkInfoToJapanese extends Command
{
    protected $signature = 'app:translate-drink-info-to-japanese';

    protected $description = 'Translate drink information from English to Japanese';

    public function handle()
    {
        $tr = new GoogleTranslate('ja');
        $drinks = Drink::get();

        foreach ($drinks as $drink) {
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
