<script setup>
definePageMeta({
  middleware: "auth",
});

const { user } = useAuth();
const { $apiFetch } = useNuxtApp();

const favoriteDrinks = ref([]);
const fetchFavorites = async () => {
  try {
    const response = await $apiFetch(`/api/mypage`, {
      method: "GET",
    });
    favoriteDrinks.value = response;
  } catch (e) {
    console.log(e.response._data.error);
  }
};

const hasFavoriteDrinks = computed(
  () => Array.isArray(favoriteDrinks.value) && favoriteDrinks.value.length != 0,
);

onMounted(fetchFavorites);
</script>

<template>
  <div>
    <UseSeoMeta />
    <div class="max-w-screen-sm mx-auto mt-16 mb-20">
      <div class="mx-4 min-h-dvh">
        <h1 class="text-center text-2xl md:text-4xl font-bold">Profile</h1>
        <div class="max-w-40 mx-auto">
          <svg
            width="100%"
            height="100%"
            viewBox="0 0 800 800"
            version="1.1"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            xml:space="preserve"
            xmlns:serif="http://www.serif.com/"
            style="
              fill-rule: evenodd;
              clip-rule: evenodd;
              stroke-linejoin: round;
              stroke-miterlimit: 2;
            "
          >
            <g transform="matrix(1,0,0,1,-235,-809)">
              <g transform="matrix(2.02015,0,0,2.02017,-51.8034,252.584)">
                <rect
                  x="142.327"
                  y="275.741"
                  width="396.011"
                  height="396.011"
                  style="fill: none"
                />
                <g transform="matrix(0.495014,0,0,0.495007,-1818.69,-130.418)">
                  <circle
                    cx="4361.54"
                    cy="1220.52"
                    r="308.919"
                    style="fill: url(#_Linear1)"
                  />
                </g>
                <g transform="matrix(0.495014,0,0,0.495007,25.6434,-125.031)">
                  <path
                    d="M425.719,1436.12L425.719,1431.17C425.719,1351.48 490.417,1286.78 570.108,1286.78L701.329,1286.78C781.02,1286.78 845.719,1351.48 845.719,1431.17L845.719,1436.12C790.578,1487.27 716.773,1518.55 635.719,1518.55C554.664,1518.55 480.859,1487.27 425.719,1436.12Z"
                    style="fill: white"
                  />
                </g>
                <g transform="matrix(0.209098,0,0,0.209095,-571.657,182.797)">
                  <circle
                    cx="4361.54"
                    cy="1220.52"
                    r="308.919"
                    style="fill: white"
                  />
                </g>
              </g>
            </g>
            <defs>
              <linearGradient
                id="_Linear1"
                x1="0"
                y1="0"
                x2="1"
                y2="0"
                gradientUnits="userSpaceOnUse"
                gradientTransform="matrix(800,-800.011,800.011,800,3961.54,1620.52)"
              >
                <stop
                  offset="0"
                  style="stop-color: rgb(122, 192, 232); stop-opacity: 1"
                />
                <stop
                  offset="1"
                  style="stop-color: rgb(89, 86, 172); stop-opacity: 1"
                />
              </linearGradient>
            </defs>
          </svg>
        </div>
        <h5 class="text-center md:text-2xl">{{ user.name }}</h5>
        <div role="tablist" class="tabs tabs-bordered mt-10">
          <div role="tab" class="tab text-lg">お気に入りしたドリンク</div>
        </div>
        <div v-if="hasFavoriteDrinks">
          <div v-for="drink in favoriteDrinks" :key="drink.id" class="mt-6">
            <NuxtLink class="h-full block" :href="`/drinks/${drink.id}`">
              <div class="card card-side bg-base-100 shadow-xl">
                <figure>
                  <img
                    :src="drink.image_url"
                    :alt="drink.name_en"
                    class="w-48 aspect-square"
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
        <div v-else>
          <p class="text-lg text-center mt-5">
            お気に入りに追加したドリンクがありません
          </p>
        </div>
        <div class="flex justify-center mt-20">
          <NuxtLink class="text-center underline" href="/delete"
            >退会をご希望の方はこちら</NuxtLink
          >
        </div>
      </div>
    </div>
  </div>
</template>
