// @ts-check
import withNuxt from "./.nuxt/eslint.config.mjs";

export default withNuxt(
  // Your custom configs here
  {
    rules: {
      "no-console": "off",
      "vue/html-self-closing": "off",
    },
  },
);
