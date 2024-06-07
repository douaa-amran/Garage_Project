/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    'node_modules/preline/dist/*.js',
  ],
  theme: {
    extend: {
      colors:{
        primaryBlack:"#2E2E2E",
        customGrey:"#F1F5FE",
      }
    },
  },
  plugins: [
    require('preline/plugin'),
  ],
}

