import { NuxtConfig } from 'nuxt/schema';

declare module 'nuxt/schema' {
  interface NuxtConfig {
    server
    nuxtSanctumAuth?: {
      token: boolean;
      baseUrl: string;
      endpoints: Array;
      csrf: Array;
      redirects: Array;
    };
  }
}