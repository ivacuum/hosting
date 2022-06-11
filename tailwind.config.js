const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/js/**/*.js',
    './resources/js/**/*.vue',
    './resources/svg/*.svg',
    './resources/views/**/*.blade.php',
  ],
  theme: {
    extend: {
      boxShadow: {
        'box-b': 'inset 0 -2px 0 var(--tw-shadow-color)',
      },
      colors: {
        current: 'currentColor',
        muted: '#6c757d',
        light: 'hsla(210, 16.7%, 97.6%)',
        'aa-100': 'hsla(0, 100%, 0%, 0.03)',
        blueish: {
          500: '#4299e1',
          600: '#3182ce',
          700: '#2b6cb0',
          800: '#2c5282',
        },
        greenish: {
          600: '#39a26a',
          700: '#2f855a',
        },
        grey: {
          100: 'hsla(208, 10%, 95%)',
          200: 'hsla(208, 10%, 90%)',
          300: 'hsla(208, 10%, 80%)',
          400: 'hsla(208, 10%, 70%)',
          500: 'hsla(208, 10%, 60%)',
          600: 'hsla(208, 10%, 50%)',
          700: 'hsla(208, 14%, 40%)',
          800: 'hsla(208, 18%, 28%)',
          900: 'hsla(208, 22%, 16%)',
        },
        orange: colors.orange,
        orangeish: {
          500: '#ed8936',
          600: '#dd6b20',
        },
        teal: colors.teal,

        // Socials
        facebook: {
          600: 'hsla(227, 50%, 38%)',
          700: 'hsla(227, 50%, 28%)',
        },
        github: {
          600: 'hsla(0, 0%, 20%)',
          700: 'hsla(0, 0%, 10%)',
        },
        google: {
          600: 'hsla(5, 68%, 53%)',
          700: 'hsla(5, 68%, 43%)',
        },
        odnoklassniki: {
          600: 'hsla(25, 88%, 56%)',
          700: 'hsla(25, 88%, 46%)',
        },
        telegram: {
          600: 'hsla(200, 66%, 48%)',
          700: 'hsla(200, 66%, 38%)',
        },
        twitter: {
          600: 'hsla(202, 90%, 57%)',
          700: 'hsla(202, 90%, 47%)',
        },
        viber: {
          600: 'hsla(274, 48%, 46%)',
          700: 'hsla(274, 48%, 36%)',
        },
        vk: {
          600: 'hsla(211, 30%, 46%)',
          700: 'hsla(211, 30%, 36%)',
        },
        whatsapp: {
          600: 'hsla(114, 44%, 50%)',
          700: 'hsla(114, 44%, 40%)',
        },
        yandex: {
          600: 'hsla(0, 100%, 50%)',
          700: 'hsla(0, 100%, 40%)',
        },
        // $blue: #337ab7;
        // $orange: #fd7e14;
        // $flame: #e05b2f;
        // $forest: #1fb27e;
        // $sunny: #f2f281;
        // $cerulean: #3c75c2;
        // $mahogany: #7040ad;
        // $sky: #89d2f6;
      },
      flex: {
        'h-full': '1 0 auto',
      },
      fontFamily: {
        sans: [
          'ui-rounded',
          'system-ui',
          '-apple-system',
          'BlinkMacSystemFont',
          '"Segoe UI"',
          'Roboto',
          '"Helvetica Neue"',
          'Arial',
          '"Noto Sans"',
          'sans-serif',
          '"Apple Color Emoji"',
          '"Segoe UI Emoji"',
          '"Segoe UI Symbol"',
          '"Noto Color Emoji"',
        ],
      },
      fontSize: {
        '2xs': '0.6875rem',
        '2sm': '0.8125rem',
      },
    },
    screens: {
      sm: '576px',
      md: '768px',
      lg: '992px',
      xl: '1200px',
    },
    container: {
      center: true,
      padding: '1rem',
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    // require('@tailwindcss/typography'),
  ],
}
