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
        primary: "#A594F9",
        secondary: "#CDC1FF",
        third: "#F5EFFF",
        fourth: "#E5D9F2",
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
