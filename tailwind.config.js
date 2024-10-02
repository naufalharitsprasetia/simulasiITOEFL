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
        primary: "#E5D9F2",
        secondary: "#F5EFFF",
        third: "#CDC1FF",
        fourth: "#A594F9",
      },
      fontFamily: {
        poppins: ["Poppins"],
        montserrat: ["Montserrat"],
        montaga: ["Montaga"],
      },
    },
  },
  plugins: [],
};
