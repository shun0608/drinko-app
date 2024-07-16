<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Drink>
 */
class DrinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $ingredients = [];
        for ($i = 1; $i <= 15; $i++) {
            $ingredients['ingredient_en'.$i] = fake()->sentence(3);
            $ingredients['ingredient_ja'.$i] = fake()->realText(12);
            $ingredients['measure_en'.$i] = fake()->sentence(2);
            $ingredients['measure_ja'.$i] = fake()->realText(12);
        }

        $test = [
            'cocktailDB_id' => fake()->numerify('#####'),
            'name_en' => fake()->sentence(5),
            'name_ja' => fake()->realText(10),
            'recipe_en' => fake()->paragraph(5),
            'recipe_ja' => fake()->realText(40),
            'image_url' => 'https://www.thecocktaildb.com/images/media/drink/vuquyv1468876052.jpg',
        ];

        return $test + $ingredients;
    }
}
