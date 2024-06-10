import { NuxtConfig } from 'nuxt/schema';

declare module 'nuxt/schema' {
  interface NuxtConfig {
    nuxtSanctumAuth?: {
      token: boolean;
      baseUrl: string;
      endpoints: Array;
      csrf: Array;
      redirects: Array;
    };
  }
}