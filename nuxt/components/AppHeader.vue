<script setup>
import { onMounted } from "vue";
const { $sanctumAuth } = useNuxtApp();
const auth = useAuth();
const router = useRouter();
const loading = ref(true);
const { $toast } = useNuxtApp();
console.log(auth);

const showToast = (message, type) => {
  $toast.open({
    message,
    type: type,
  });
};

onMounted(async () => {
  try {
    await $sanctumAuth.getUser();
    loading.value = false;
  } catch (e) {
    console.e("Failed to get user:", error);
  }
});

const logout = async () => {
  await $sanctumAuth.logout((data) => {
    // location.href = "/" + "?loggedout=true";
    router.push({ path: "/", query: { loggedout: "true" } });
    showToast("ログアウトしました。");
  });
};
</script>

<template>
  <header class="bg-white drop-shadow z-20 sticky top-0">
    <div class="navbar max-w-screen-lg mx-auto">
      <div class="flex-1">
        <NuxtLink class="text-2xl font-bold p-3" href="/">Drinko</NuxtLink>
        <!-- <form>
          <div class="flex">
            <div class="relative w-full">
              <input
                type="search"
                id="search-dropdown"
                class="search-dropdown block px-2 py-3 w-full z-20 text-gray-400 bg-white rounded-e-lg border border-gray-300 dark:bg-white dark:border-gray-300 dark:placeholder-gray-300 dark:text-gray-400 focus:outline-none"
                placeholder="ソフトドリンク検索"
                required
              />
              <button
                type="submit"
                class="search-button absolute top-0 end-0 px-3 py-4 text-sm font-medium text-white bg-white rounded-e-lg border border-gray-300 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-white dark:hover:bg-gray-300 dark:focus:ring-gray-300"
              >
                <svg
                  class="w-4 h-4"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 20 20"
                >
                  <path
                    stroke="gray"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                  />
                </svg>
              </button>
            </div>
          </div>
        </form> -->
      </div>
      <!-- ログインしていないとき -->
      <div v-if="!auth.loggedIn">
        <div class="flex-none gap-2 hidden md:flex">
          <NuxtLink class="btn btn-neutral" href="/login">ログイン</NuxtLink>
          <NuxtLink class="btn" href="/register">新規登録</NuxtLink>
        </div>
        <div class="drawer drawer-end">
          <input id="header-drawer" type="checkbox" class="drawer-toggle" />
          <div class="drawer-content">
            <label
              for="header-drawer"
              class="btn btn-square btn-ghost md:hidden hover:bg-gray-300"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                class="inline-block w-6 h-6 stroke-current"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"
                ></path>
              </svg>
            </label>
          </div>
          <div class="drawer-side">
            <label
              for="header-drawer"
              aria-label="close sidebar"
              class="drawer-overlay"
            ></label>
            <div></div>
            <ul
              class="menu p-4 w-80 min-h-full bg-base-200 text-base-content gap-2"
            >
              <!-- Sidebar content here -->
              <li class="">
                <NuxtLink class="btn btn-neutral" href="/login"
                  >ログイン</NuxtLink
                >
              </li>
              <li>
                <NuxtLink class="btn btn-outline" href="/register"
                  >新規登録</NuxtLink
                >
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div v-else-if="auth.loggedIn" class="flex-none gap-2">
        <div class="dropdown dropdown-end">
          <div
            tabindex="0"
            role="button"
            class="btn btn-ghost btn-circle avatar"
          >
            <div class="w-12 rounded-full">
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
                    <g
                      transform="matrix(0.495014,0,0,0.495007,-1818.69,-130.418)"
                    >
                      <circle
                        cx="4361.54"
                        cy="1220.52"
                        r="308.919"
                        style="fill: url(#_Linear1)"
                      />
                    </g>
                    <g
                      transform="matrix(0.495014,0,0,0.495007,25.6434,-125.031)"
                    >
                      <path
                        d="M425.719,1436.12L425.719,1431.17C425.719,1351.48 490.417,1286.78 570.108,1286.78L701.329,1286.78C781.02,1286.78 845.719,1351.48 845.719,1431.17L845.719,1436.12C790.578,1487.27 716.773,1518.55 635.719,1518.55C554.664,1518.55 480.859,1487.27 425.719,1436.12Z"
                        style="fill: white"
                      />
                    </g>
                    <g
                      transform="matrix(0.209098,0,0,0.209095,-571.657,182.797)"
                    >
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
          </div>
          <ul
            tabindex="0"
            class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52"
          >
            <li>
              <NuxtLink class="py-2" :to="`/mypage/${auth.user.id}`">
                プロフィール
              </NuxtLink>
            </li>
            <li>
              <NuxtLink class="py-2" @click="logout()">ログアウト</NuxtLink>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </header>
</template>
