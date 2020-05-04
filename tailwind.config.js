module.exports = {
  purge: false,
  theme: {
    customForms: (theme) => ({
      default: {
        checkbox: {
          borderColor: theme('colors.gray.300'),
        },
        input: {
          borderColor: theme('colors.gray.300'),
          borderRadius: theme('borderRadius.default'),
          boxShadow: 'inset 0 1px 1px rgba(0, 0, 0, 0.075)',
          display: 'block',
          color: theme('colors.gray.700'),
          paddingTop: '0.375rem',
          paddingBottom: '0.375rem',
          width: '100%',
          '&::placeholder': {
            color: theme('colors.gray.400'),
          },
          '&:focus': {
            borderColor: 'hsla(208, 57%, 71%)',
            boxShadow: 'inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 0 0.2rem rgba(51, 122, 183, 0.25)',
          },
        },
        radio: {
          borderColor: theme('colors.gray.300'),
        },
        select: {
          borderColor: theme('colors.gray.300'),
          boxShadow: 'inset 0 1px 1px rgba(0, 0, 0, 0.075)',
          color: theme('colors.gray.700'),
          display: 'block',
          paddingTop: '0.375rem',
          paddingBottom: '0.375rem',
          width: '100%',
          '&:focus': {
            borderColor: 'hsla(208, 57%, 71%)',
            boxShadow: 'inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 0 0.2rem rgba(51, 122, 183, 0.25)',
          },
        },
        textarea: {
          borderColor: theme('colors.gray.300'),
          boxShadow: 'inset 0 1px 1px rgba(0, 0, 0, 0.075)',
          color: theme('colors.gray.700'),
          display: 'block',
          paddingTop: '0.375rem',
          paddingBottom: '0.375rem',
          width: '100%',
          '&:focus': {
            borderColor: 'hsla(208, 57%, 71%)',
            boxShadow: 'inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 0 0.2rem rgba(51, 122, 183, 0.25)',
          },
        },
      },
    }),
    extend: {
      colors: {
        current: 'currentColor',
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
        orangeish: {
          500: '#ed8936',
          600: '#dd6b20',
        },

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
      },
      flex: {
        'h-full': '1 0 auto',
      },
      fontSize: {
        '2xs': '0.6875rem',
        '2sm': '0.8125rem',
      },
      height: {
        '1/2-screen': '50vh',
      },
      inset: {
        '1/2': '50%',
      },
      maxWidth: {
        none: 'none',
        '400px': '400px',
        '500px': '500px',
        '600px': '600px',
        '700px': '700px',
        '1000px': '1000px',
      },
      padding: {
        '3/4': '75%',
      },
      spacing: {
        '2px': '2px',
      },
    },
    screens: {
      sm: '576px',
      md: '768px',
      lg: '992px',
      xl: '1200px',
      dark: { raw: '(prefers-color-scheme: dark)' },
    },
    container: {
      center: true,
      padding: '1rem',
    },
  },
  variants: {
    opacity: ['responsive', 'hover', 'focus', 'disabled'],
    textColor: ['responsive', 'hover', 'focus', 'group-hover'],
    textDecoration: ['responsive', 'hover', 'focus', 'group-hover'],
    visibility: ['responsive', 'group-hover'],
  },
  corePlugins: {
    backgroundOpacity: false,
    borderOpacity: false,
    divideOpacity: false,
    placeholderOpacity: false,
    textOpacity: false,
  },
  plugins: [
    // eslint-disable-next-line global-require
    require('@tailwindcss/ui'),
  ],
}
