<script setup>
const { $apiFetch } = useNuxtApp();

const currentPage = new URL(location.href).searchParams.get("page");
const page = ref(currentPage ? parseInt(currentPage) : 1);

const { data: drinks, total } = await $apiFetch(`/api/drinks`, {
  method: "GET",
  params: { page: page.value },
});

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
  <UseSeoMeta title="ドリンク一覧" description="Drinkoのドリンク一覧ページ" />
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
      <div v-for="drink in drinks" :key="drink.id">
        <DrinkCard :drink="drink" />
      </div>
    </div>
  </div>

  <UPagination
    v-model="page"
    :page-count="12"
    :total="total"
    :to="
      (page) => ({
        query: { page },
      })
    "
    :ui="{
      wrapper: 'justify-center mt-24 mb-48 scale-125 sm:scale-150',
    }"
  />
</template>
