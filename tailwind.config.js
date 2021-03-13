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
            mono: ['"Syne Mono"', ...defaultTheme.fontFamily.mono],
        },
        letterSpacing: {
            boxes: '1em',
            'names': '0.5em',
            'input-boxes': '0.9em',
        },
        spacing: {
            35: '8.75rem'
        }
    },
  },
  variants: {
    extend: {
        borderWidth: ['first'],
        letterSpacing: ['focus'],
    },
  },
  plugins: [],
}
