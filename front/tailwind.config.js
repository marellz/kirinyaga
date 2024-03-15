/** @type {import('tailwindcss').Config} */
import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'

export default {
  content: [],
  theme: {
    fontFamily: {
      sans: ['Noto Sans', ...defaultTheme.fontFamily.sans]
    },
    extend: {
      colors: {
        gunmetal: '#1b2f33ff',
        'light-cyan': '#cbeef3ff',
        'tea-rose-red': '#eec6caff',
        'red-crayola': '#ef3054ff',
        madder: '#a41623ff'
      }
    }
  },
  plugins: [forms]
}

