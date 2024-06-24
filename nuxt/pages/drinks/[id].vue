<script setup>
const { $apiFetch } = useNuxtApp();
const { $toast } = useNuxtApp();

const urlPathId = location.pathname.split("/")[2];
const { data } = await useFetch(() => `/api/drinks/${urlPathId}`, {
  baseURL: "http://localhost:8000",
});

const showToast = (message, type) => {
  $toast.open({
    message,
    type: type,
  });
};

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

const isFavorite = ref(false);

const updateIsFavoriteStatus = async () => {
  try {
    const response = await $apiFetch(`/api/isFavorite/${urlPathId}`, {
      method: "GET",
    });
    isFavorite.value = response;
  } catch (e) {
    console.error(e.response);
  }
};

const updateFavorite = async () => {
  try {
    const response = await $apiFetch(`api/favorite/${urlPathId}/`, {
      method: "POST",
      baseURL: "http://localhost:8000",
    });
    await updateIsFavoriteStatus();
  } catch (e) {
    showToast(
      "お気に入り機能をご利用いただくには、ログインが必要です。",
      "error"
    );
  }
};

onMounted(updateIsFavoriteStatus);
</script>

<template>
  <div class="max-w-screen-lg mx-auto mt-8 mb-28">
    <UBreadcrumb
      :links="links"
      :ui="{
        wrapper: 'mx-4',
        li: 'text-primary dark:text-primary',
        active: 'text-primary dark:text-primary-400',
        inactive: 'hover:text-gray-700 dark:hover:text-gray-200',
      }"
    />
    <div class="mx-4">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-16 mt-5">
        <figure class="">
          <img
            :src="drink.image_url"
            :alt="drink.name_en"
            class="aspect-square object-cover w-full"
          />
        </figure>
        <div>
          <h1 class="text-3xl font-bold">{{ drink.name_en }}</h1>
          <h4 class="text-md font-bold mt-3">{{ drink.name_ja }}</h4>
          <h5 class="text-lg mt-5">材料</h5>
          <ul class="list-disc list-inside ms-1">
            <li v-for="ingredient in drinkIngredients">
              {{ ingredient }}
            </li>
          </ul>
          <h5 class="text-lg mt-5">作り方</h5>
          <p class="mt-1">{{ drink.recipe_ja }}</p>
          <div class="flex flex-row flex-wrap gap-2 mt-5">
            <button
              :class="[
                'btn btn-sm h-10 text-xs rounded-md',
                { favorite: isFavorite },
              ]"
              @click="updateFavorite()"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                :fill="isFavorite ? 'white' : 'none'"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                />
              </svg>
              お気に入り
            </button>
            <SocialShare
              v-for="network in ['facebook', 'twitter', 'line']"
              :key="network"
              :network="network"
              :styled="true"
              :label="true"
              class="text-white h-10"
            />
          </div>
        </div>
      </div>
      <h5 class="text-2xl mt-20">おすすめ</h5>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7 mt-8">
        <div v-for="drink in drinks" :key="drink.id">
          <DrinkCard :drink="drink" />
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.favorite {
  color: #ffffff;
  background-color: #ff3333 !important;
}
</style>
