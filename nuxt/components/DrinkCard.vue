<script setup>
const props = defineProps({
  drink: Object,
});
</script>

<template>
  <NuxtLink class="h-full block" :href="`/drinks/${drink.id}`">
    <div class="card card-compact bg-base100 shadow-xl h-full">
      <figure>
        <img
          :src="drink.image_url"
          :alt="drink.name_en"
          class="aspect-square object-cover block w-full"
        />
      </figure>
      <div class="card-body">
        <h2 class="card-title">{{ drink.name_en }}</h2>
        <p>{{ drink.name_ja }}</p>
      </div>
    </div>
  </NuxtLink>
</template>
