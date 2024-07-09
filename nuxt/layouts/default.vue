<script setup>
useHead({
  htmlAttrs: {
    lang: "ja",
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
</script>

<template>
  <AppHeader />
  <main class="bg-white">
    <slot />
  </main>
  <AppFooter />
</template>
