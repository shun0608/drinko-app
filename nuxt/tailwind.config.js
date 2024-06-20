/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./components/**/*.{vue,js,jsx,ts,tsx}",
    "./pages/**/*.{vue,js,jsx,ts,tsx}",
  ],
  theme: {
    extend: {
      aspectRatio: {
        auto: "auto",
        square: "1 / 1",
        video: "16 / 9",
      },
    },
  },
  plugins: [require("daisyui")],
  daisyui: {
    themes: [
      "corporate",
      // {
      //   mytheme: {
      //     // 用意されている各種の色も設定できる
      //     // primary: "#a991f7", // btn-primaryなどの背景の色
      //     // "primary-content": "#ffffff", // btn-primaryなどの文字の色
      //     // "base-100": "#ffffff", // 全体の背景色
      //     // "base-content": "#372f38", // 全体の文字の色
      //   },
      // },
    ],
  },
};
