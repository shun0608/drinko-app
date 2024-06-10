/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./components/**/*.{vue,js,jsx,ts,tsx}",
    "./pages/**/*.{vue,js,jsx,ts,tsx}",
  ],
  theme: {
    extend: {},
  },
  plugins: [require("daisyui")],
};
