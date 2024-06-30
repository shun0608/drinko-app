<script setup>
const router = useRouter();
const { $apiFetch } = useNuxtApp();

const { data } = await $apiFetch("/api/recommend", {
  method: "GET",
});
const drinks = data.value;

const keyword = ref("");
const navigateToSearch = () => {
  router.push({
    path: "/search",
    query: { keyword: keyword.value.trim().replace(/[\s]+/g, " ") },
  });
};
</script>

<template>
  <UseSeoMeta />
  <div class="bg-drink relative">
    <div class="absolute bottom-5 start-4 md:inset-y-2/4 md:start-24">
      <h1 class="text-5xl md:text-8xl font-black">Drinko</h1>
      <h3 class="text-2xl md:text-4xl font-black mt-7">
        丁寧に作ったドリンクで安らぎのひとときを
      </h3>
      <p class="mt-5">
        Drinkoでは、世界各国のソフトドリンクとその作り方を調べることができます。<br />
        検索機能では、あなたの今の気分に合わせて、<br />
        厳選したソフトドリンクをオススメします。<br />
        アルコールが呑めない人にもドリンクの喜びを味わって欲しい。<br />
        そんな願いを込めてつくりました。
      </p>
    </div>
  </div>

  <section class="my-28">
    <SectionTitle>
      <template #english>Recommended</template>
      <template #japanese>おすすめ</template>
    </SectionTitle>
    <div class="mx-auto max-w-screen-lg mt-10">
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-7 mx-3">
        <div v-for="drink in drinks" :key="drink.id">
          <DrinkCard :drink="drink" />
        </div>
      </div>
    </div>
    <div class="flex justify-center mt-10">
      <NuxtLink class="btn btn-wide btn-neutral" href="/drinks">
        ドリンク一覧
      </NuxtLink>
    </div>
  </section>

  <section class="my-28 px-4">
    <SectionTitle>
      <template #english>Search</template>
      <template #japanese>ドリンク検索</template>
    </SectionTitle>
    <div class="max-w-3xl mx-auto my-14 px-4 bg-gray-300 rounded-3xl">
      <form @submit.prevent="navigateToSearch" class="py-14 mx-auto">
        <label class="form-control w-full max-w-lg mx-auto">
          <div class="label">
            <span class="label-text">フリーワード</span>
          </div>
          <input
            type="text"
            v-model="keyword"
            class="input input-bordered w-full max-w-lg"
            required
          />
        </label>
        <!-- <label class="form-control w-full max-w-lg mx-auto mt-3">
          <div class="label">
            <span class="label-text">今の気分</span>
          </div>
          <select class="select select-bordered">
            <option selected>今の気分を選んでください</option>
            <option>Star Wars</option>
            <option>Harry Potter</option>
            <option>Lord of the Rings</option>
            <option>Planet of the Apes</option>
            <option>Star Trek</option>
          </select>
        </label> -->
        <label class="form-control mt-14">
          <button type="submit" class="btn btn-neutral w-full max-w-lg mx-auto">
            検索
          </button>
        </label>
      </form>
    </div>
  </section>
</template>
