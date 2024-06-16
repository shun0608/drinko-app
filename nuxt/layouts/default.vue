<script setup lang="ts">
useHead({
  htmlAttrs: {
    lang: "ja",
    // prefix: 'og: http://ogp.me/ns#'
  },
  link: [
    {
      rel: "preconnect",
      href: "https://fonts.googleapis.com",
    },
    {
      rel: "preconnect",
      href: "https://fonts.gstatic.com",
      crossorigin: "",
    },
    {
      rel: "stylesheet",
      href: "https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap",
    },
  ],
});

useSeoMeta({
  // ここからした４つ動的に変更できるように
  title: "Drinko",
  ogTitle: "Drinko",
  description: "丁寧に作ったドリンクで安らぎのひとときを",
  ogDescription: "丁寧に作ったドリンクで安らぎのひとときを",
  ogImage: {
    url: "~/assets/img/site-thumbnail.jpg",
    type: "image/jpeg",
  },
  // この下は動的に変更でるようにする
  ogUrl: "http://~~",
  // この下も動的に変更できるようにする　下層ページをarticleに
  ogType: "website",
  ogLocale: "ja",
  ogSiteName: "Drinko",
  twitterCard: "summary",
  // ここから下２つは動的に変更
  twitterTitle: "Drinko",
  twitterDescription: "丁寧に作ったドリンクで安らぎのひとときを",
  twitterImage: {
    url: "~/assets/img/site-thumbnail.jpg",
    type: "image/jpeg",
  },
  charset: "utf-8",
  author: "shun0608",
  viewport: "width=device-width, initial-scale=1.0",
});
</script>

<template>
  <header class="bg-white drop-shadow">
    <!-- <div class="main-container">
      <div class="header-left">
        <h1 class="text-3xl text-black font-bold">Drinko</h1>

      </div>
      <div class="header-right"></div>
    </div> -->
    <div class="navbar">
      <div class="flex-1">
        <a class="btn btn-ghost text-xl" href="/">Drinko</a>
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
      <div class="flex-none gap-2">
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
              <a class="justify-between">
                Profile
                <span class="badge">New</span>
              </a>
            </li>
            <li><a>Settings</a></li>
            <li><a>Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>
  <main class="bg-white">
    <slot />
  </main>
  <footer></footer>
</template>
