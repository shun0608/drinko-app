export default defineNuxtConfig({
  modules: [
    'nuxt-auth-sanctum'
  ],
  ssr: false,
  devtools: { enabled: true },
  nuxtSanctumAuth: {
    token: false,
    baseUrl: "http://localhost:80",
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