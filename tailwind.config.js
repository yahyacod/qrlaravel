/** @type {import('tailwindcss').Config} */
export default {
    content: [
      './public/index.html',
      './resources/**/*.{html,js,vue,blade.php}',
    ],
    theme: {
      extend: {},
    },
    plugins: [],
  }
  module.exports = {
    content: [
      './resources/**/*.blade.php',
      './resources/**/*.js',
      './resources/**/*.vue',
    ],
    theme: {
      extend: {},
    },
    plugins: [],
  }