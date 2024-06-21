<script setup>
import DrinkCard from "../components/DrinkCard.vue";

const urlPathId = location.pathname.split("/")[2];
const { data } = await useFetch(() => `/api/drinks/${urlPathId}`, {
  baseURL: "http://localhost:8000",
});

const drink = data.value.drink;
const drinks = data.value.recommended;

const drinkIngredients = [];
for (let i = 1; i <= 15; i++) {
  let ingredientKey = "ingredient_ja" + i;
  let measureKey = "measure_ja" + i;
  let ingredient = drink[ingredientKey];
  let measure = drink[measureKey];
  if (ingredient && measure) {
    drinkIngredients.push(`${ingredient} ${measure}`);
  }
}

const links = useBreadcrumbItems({
  overrides: [
    {
      label: "ホーム",
    },
    {
      label: "ドリンク一覧",
    },
    {
      label: drink.name_en,
    },
  ],
});
</script>

<template>
  <div class="max-w-screen-lg mx-auto mt-8">
    <UBreadcrumb
      :links="links"
      :ui="{
        wrapper: 'mx-4',
        li: 'text-primary dark:text-primary',
        active: 'text-primary dark:text-primary-400',
        inactive: 'hover:text-gray-700 dark:hover:text-gray-200',
      }"
    />
  </div>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <figure>
      <img
        :src="drink.image_url"
        :alt="drink.name_en"
        class="aspect-square object-cover"
      />
    </figure>
    <div>
      <h1>{{ drink.name_en }}</h1>
      <h4>{{ drink.name_ja }}</h4>
      <h5>材料</h5>
      <ul>
        <li v-for="ingredient in drinkIngredients">
          {{ ingredient }}
        </li>
      </ul>
      <h5>作り方</h5>
      <p>{{ drink.recipe_ja }}</p>
      <div class="flex flex-row gap-2">
        <SocialShare
          v-for="network in ['facebook', 'twitter', 'line']"
          :key="network"
          :network="network"
          :styled="true"
          :label="true"
          class="text-white"
        />
      </div>
    </div>
  </div>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    <div v-for="drink in drinks" :key="drink.id">
      <DrinkCard :drink="drink" />
    </div>
  </div>
</template>
