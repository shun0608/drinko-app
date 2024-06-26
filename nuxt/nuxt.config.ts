export default defineNuxtConfig({
  modules: [
    'nuxt-sanctum-auth',
    "@nuxt/ui",
    "@nuxtjs/seo",
    "@stefanobartoletti/nuxt-social-share"
  ],
  ssr: false,
  devtools: { enabled: true },
  css: ['~/assets/styles/main.scss'],
  nuxtSanctumAuth: {
    token: false,
    baseUrl: "https://api.drinko.jp",
    endpoints: {
      csrf: "/sanctum/csrf-cookie",
      login: "/api/login",
      logout: "/api/logout",
      user: "/api/user",
    },
    csrf: {
      headerKey: "X-XSRF-TOKEN",
      cookieKey: "XSRF-TOKEN",
      tokenCookieKey: "nuxt-sanctum-auth-token",
    },
    redirects: {
      home: "/",
      login: "/login",
      logout: "/",
    }
  },
})