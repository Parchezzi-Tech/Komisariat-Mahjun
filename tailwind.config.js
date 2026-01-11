import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],

    theme: {
  extend: {
    fontFamily: {
      cairo: ['Cairo', 'sans-serif'],
      amiri: ['Amiri', 'serif'],
    },
    colors: {
      green: {
        700: '#00692A',
        600: '#008C3A',
      }
    },
    keyframes: {
      marquee: {
        '0%': { transform: 'translateX(0%)' },
        '100%': { transform: 'translateX(-50%)' }
      }
    }
  }
},
plugins: [
  function ({ addVariant }) {
    addVariant('khidmah', '.khidmah &')
  }
]

};

