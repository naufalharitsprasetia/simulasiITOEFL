/**
 * @format
 * @type {import('tailwindcss').Config}
 */

export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: "#164863",
        secondary: "#427D9D", // 427D9D
        third: "#DDF2FD", // 9BBEC8
        fourth: "#9BBEC8", // DDF2FD
      },
      fontFamily: {
        poppins: ["Poppins"],
        crimson: ["Crimson Text"],
        montserrat: ["Montserrat"],
        montaga: ["Montaga"],
      },
    },
  },
  plugins: [],
};
