<script setup>
const props = defineProps({
  drink: {
    type: Object,
    default: () => ({}),
  },
});
</script>

<template>
  <NuxtLink class="h-full block" :href="`/drinks/${props.drink.id}`">
    <div class="card card-compact bg-base100 shadow-xl h-full">
      <figure>
        <img
          :src="props.drink.image_url"
          :alt="props.drink.name_en"
          class="aspect-square object-cover block w-full"
        />
      </figure>
      <div class="card-body">
        <h2 class="card-title">{{ props.drink.name_en }}</h2>
        <p>{{ props.drink.name_ja }}</p>
      </div>
    </div>
  </NuxtLink>
</template>
