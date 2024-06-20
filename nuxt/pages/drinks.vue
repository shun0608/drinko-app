<script setup>
const currentPage = new URL(location.href).searchParams.get("page");
const page = ref(currentPage ? parseInt(currentPage) : 1);

const { data } = await useFetch(() => `/api/drinks?page=${page.value}`, {
  baseURL: "http://localhost:8000",
});
const drinkPaginator = data.value;

watch(page, () => {
  location.href = "/drinks?page=" + page.value;
});

const links = useBreadcrumbItems({
  overrides: [
    {
      label: "ホーム",
    },
    {
      label: "ドリンク一覧",
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

  <div class="mx-auto max-w-screen-lg mt-10">
    <div
      class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mx-3"
    >
      <div v-for="drink in drinkPaginator.data" :key="drink">
        <NuxtLink class="h-full block">
          <!-- <NuxtLink class="h-full block" :href="`/drinks/${drink.id}`"> -->
          <div class="card card-compact bg-base-100 shadow-xl h-full">
            <figure>
              <img
                :src="drink.image_url"
                alt="Shoes"
                class="aspect-square object-cover"
              />
            </figure>
            <div class="card-body">
              <h2 class="card-title">{{ drink.name_en }}</h2>
              <p>{{ drink.name_ja }}</p>
            </div>
          </div>
        </NuxtLink>
      </div>
    </div>
  </div>

  <UPagination
    v-model="page"
    :page-count="12"
    :total="drinkPaginator.total"
    :to="(page: number) => ({
      query: { page }
    })"
    :ui="{
      wrapper: 'justify-center mt-24 mb-48 scale-125 sm:scale-150',
    }"
  />
</template>
