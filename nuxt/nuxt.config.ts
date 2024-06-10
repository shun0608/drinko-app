export default defineNuxtConfig({
  modules: ['nuxt-sanctum-auth', '@nuxtjs/tailwindcss'],
  ssr: false,
  devtools: { enabled: true },
  nuxtsanctumAuth: {
    token: false,
    baseUrl: "http://localhost:8000",
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
      home: "/show",
      login: "/login",
      logout: "/",
    }
  }
})