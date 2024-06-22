<script setup>
definePageMeta({
  middleware: "auth",
});
const { user } = useAuth();
const { $apiFetch } = useNuxtApp();
const favoriteDrinks = ref([]);
const fetchFavorites = async () => {
  try {
    const response = await $apiFetch(`/api/mypage/${user.id}`, {
      method: "GET",
    });
    favoriteDrinks.value = response;
  } catch (e) {
    console.log(e.response);
  }
};
onMounted(fetchFavorites);
</script>

<template>
  <div v-for="drink in favoriteDrinks" :key="drink.id">
    <div class="card card-side bg-base-100 shadow-xl">
      <figure>
        <img :src="drink.image_url" :alt="drink.name_en" />
      </figure>
      <div class="card-body">
        <h2 class="card-title">{{ drink.name_en }}</h2>
        <p>{{ drink.name_ja }}</p>
        <!-- <div class="card-actions justify-end">
          <button class="btn btn-primary">Watch</button>
        </div> -->
      </div>
    </div>
  </div>
</template>
