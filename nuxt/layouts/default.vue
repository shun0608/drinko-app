<script setup>
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
    {
      rel: "stylesheet",
      href: "https://use.fontawesome.com/releases/v5.15.4/css/all.css",
      integrity:
        "sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm",
      crossorigin: "anonymous",
    },
  ],
});

useSeoMeta({
  // ここからした４つ動的に変更できるように
  // title: "Drinko",
  // ogTitle: "Drinko",
  // description: "丁寧に作ったドリンクで安らぎのひとときを",
  // ogDescription: "丁寧に作ったドリンクで安らぎのひとときを",
  // ogImage: {
  //   url: "~/assets/img/site-thumbnail.jpg",
  //   type: "image/jpeg",
  // },
  // // この下は動的に変更でるようにする
  // ogUrl: "http://~~",
  // // この下も動的に変更できるようにする　下層ページをarticleに
  // ogType: "website",
  // ogLocale: "ja",
  // ogSiteName: "Drinko",
  // twitterCard: "summary",
  // // ここから下２つは動的に変更
  // twitterTitle: "Drinko",
  // twitterDescription: "丁寧に作ったドリンクで安らぎのひとときを",
  // twitterImage: {
  //   url: "~/assets/img/site-thumbnail.jpg",
  //   type: "image/jpeg",
  // },
  // charset: "utf-8",
  // author: "shun0608",
  // viewport: "width=device-width, initial-scale=1.0",
});
</script>

<template>
  <AppHeader />
  <main class="bg-white">
    <slot />
  </main>
  <AppFooter />
</template>
