const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
  purge: [
      './resources/**/*.blade.php',
      './resources/**/*.js',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
        fontFamily: {
            sans: ['Roboto', ...defaultTheme.fontFamily.sans],
            jotto: ['"Markazi Text"', ...defaultTheme.fontFamily.serif],
            hand: ['"Patrick Hand"', ...defaultTheme.fontFamily.sans],
        },
    },
  },
  variants: {
    extend: {
        borderWidth: ['first'],
    },
  },
  plugins: [],
}
