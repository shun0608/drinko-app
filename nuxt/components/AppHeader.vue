<script setup>
import { onMounted } from "vue";
const { $sanctumAuth } = useNuxtApp();
const auth = useAuth();
const router = useRouter();
const loading = ref(true);
const { $toast } = useNuxtApp();

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
    console.log(data.message);
    router.push({ path: "/", query: { loggedout: "true" } });
    showToast("ログアウトしました。");
  });
};
</script>

<template>
  <header class="bg-white drop-shadow z-10 sticky top-0">
    <div class="navbar max-w-screen-lg mx-auto">
      <div class="flex-1">
        <a class="text-2xl font-bold p-3" href="/">Drinko</a>
        <form>
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
        </form>
      </div>
      <!-- ログインしていないとき -->
      <div v-if="!auth.loggedIn">
        <div class="flex-none gap-2 hidden md:flex">
          <a class="btn btn-neutral" href="/login">ログイン</a>
          <a class="btn" href="/register">新規登録</a>
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
                <a class="btn btn-neutral" href="/login">ログイン</a>
              </li>
              <li><a class="btn btn-outline" href="/register">新規登録</a></li>
              <li><a>Sidebar Item 1</a></li>
              <li><a>Sidebar Item 2</a></li>
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
            <div class="w-10 rounded-full">
              <img
                alt="Tailwind CSS Navbar component"
                src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg"
              />
            </div>
          </div>
          <ul
            tabindex="0"
            class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52"
          >
            <li>
              <button class="btn btn-ghost" @click="logout">ログアウト</button>
            </li>
            <li>
              <a class="justify-between">
                Profile
                <span class="badge">New</span>
              </a>
            </li>
            <li><a>Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>
</template>
