module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        green: {
          500: '#19ae96',
        },
      }
    },
  },
  plugins: [
    require('@tailwindcss/line-clamp'),
  ],
}
