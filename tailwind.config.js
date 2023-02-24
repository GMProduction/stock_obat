/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js",
  ],
  theme: {
    colors: {
      primary: "#29bac7",
      secondary: "#FF5A1F",
      secondarylight1: "#FF5A1F77",
      primarylight: "#29bac777",
      primarylight2: "#29bac722",
    },
    extend: {},
  },
  plugins: [require("flowbite/plugin")],
};
