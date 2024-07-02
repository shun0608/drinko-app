<script setup>
const route = useRoute();
const { $apiFetch } = useNuxtApp();
const { $toast } = useNuxtApp();
const showToast = (message, type) => {
  $toast.open({
    message,
    type: type,
  });
};

const drinks = ref([]);
const total = ref();
const keyword = ref(route.query.keyword || "");
const currentPage = new URL(location.href).searchParams.get("page");
const page = ref(currentPage ? parseInt(currentPage) : 1);

const fetchDrinks = async () => {
  if (keyword.value) {
    try {
      const response = await $apiFetch("/api/search", {
        method: "GET",
        params: { page: page.value, keyword: keyword.value },
      });
      drinks.value = response.data;
      total.value = response.total;
    } catch (error) {
      console.log(error);
      showToast("検索に失敗しました。再度実行してください", "error");
    }
  }
};

const generateLink = (page) => {
  return {
    path: "/search",
    query: {
      page,
      keyword: keyword.value,
    },
  };
};

const links = useBreadcrumbItems({
  overrides: [
    {
      label: "ホーム",
    },
    {
      label: `「${keyword.value}」の検索結果`,
    },
  ],
});

onMounted(fetchDrinks);
watch(route, fetchDrinks);

watch(page, () => {
  location.href = "/search?page=" + page.value + "&keyword=" + keyword;
});
</script>

<template>
  <UseSeoMeta
    :title="`${keyword}の検索結果`"
    :description="`${keyword}の検索結果`"
  />
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

  <div class="mx-auto max-w-screen-lg mt-10 min-h-dvh">
    <div v-if="drinks.length > 0">
      <div
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mx-3"
      >
        <div v-for="drink in drinks" :key="drink.id">
          <DrinkCard :drink="drink" />
        </div>
      </div>
    </div>
    <div v-else>
      <div class="mx-4">
        <p>検索結果が存在しません。</p>
      </div>
    </div>
  </div>
  <div v-if="drinks.length > 0" class="flex justify-center">
    <UPagination
      v-model="page"
      :page-count="12"
      :total="parseInt(total)"
      :to="generateLink"
      :ui="{
        wrapper: 'justify-center mt-24 mb-48 scale-125 sm:scale-150',
      }"
    />
  </div>
</template>
