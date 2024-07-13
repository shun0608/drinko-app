<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('drinks', function (Blueprint $table) {
            $table->id();
            $table->integer('cocktailDB_id');
            $table->string('name_en')->nullable();
            $table->string('name_ja')->nullable();
            for ($i = 1; $i <= 15; $i++) {
                $table->text('ingredient_en'.$i)->nullable();
                $table->text('ingredient_ja'.$i)->nullable();
                $table->text('measure_en'.$i)->nullable();
                $table->text('measure_ja'.$i)->nullable();
            }
            $table->text('recipe_en')->nullable();
            $table->text('recipe_ja')->nullable();
            $table->text('comment')->nullable();
            $table->string('image_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drinks');
    }
};
