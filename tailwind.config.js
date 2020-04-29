module.exports = {
  theme: {
    customForms: (theme) => ({
      default: {
        input: {
          borderColor: theme('colors.gray.300'),
          borderRadius: theme('borderRadius.default'),
          boxShadow: 'inset 0 1px 1px rgba(0, 0, 0, 0.075)',
          display: 'block',
          color: '#495057',
          paddingTop: '0.375rem',
          paddingBottom: '0.375rem',
          width: '100%',
        },
      },
    }),
    extend: {
      colors: {
        current: 'currentColor',
        light: 'hsl(210, 16.7%, 97.6%)',
        'aa-100': 'hsla(0, 100%, 0%, 0.03)',
        blueish: {
          500: '#4299e1',
          600: '#3182ce',
          700: '#2b6cb0',
          800: '#2c5282',
        },
        greenish: {
          300: '#9ae6b4',
          600: '#38a169',
          700: '#2f855a',
        },
        grey: {
          100: 'hsl(208, 10%, 95%)',
          200: 'hsl(208, 10%, 90%)',
          300: 'hsl(208, 10%, 80%)',
          400: 'hsl(208, 10%, 70%)',
          500: 'hsl(208, 10%, 60%)',
          600: 'hsl(208, 10%, 50%)',
          700: 'hsl(208, 14%, 40%)',
          800: 'hsl(208, 18%, 28%)',
          900: 'hsl(208, 22%, 16%)',
        },
        orangeish: {
          400: '#f6ad55',
          500: '#ed8936',
          600: '#dd6b20',
        },
        redish: {
          600: '#e53e3e',
        },
        tealish: {
          600: '#319795',
          700: '#2c7a7b',
        },

        // Socials
        facebook: {
          600: 'hsl(227, 50%, 38%)',
          700: 'hsl(227, 50%, 28%)',
        },
        github: {
          600: 'hsl(0, 0%, 20%)',
          700: 'hsl(0, 0%, 10%)',
        },
        google: {
          600: 'hsl(5, 68%, 53%)',
          700: 'hsl(5, 68%, 43%)',
        },
        odnoklassniki: {
          600: 'hsl(25, 88%, 56%)',
          700: 'hsl(25, 88%, 46%)',
        },
        telegram: {
          600: 'hsl(200, 66%, 48%)',
          700: 'hsl(200, 66%, 38%)',
        },
        twitter: {
          600: 'hsl(202, 90%, 57%)',
          700: 'hsl(202, 90%, 47%)',
        },
        viber: {
          600: 'hsl(274, 48%, 46%)',
          700: 'hsl(274, 48%, 36%)',
        },
        vk: {
          600: 'hsl(211, 30%, 46%)',
          700: 'hsl(211, 30%, 36%)',
        },
        whatsapp: {
          600: 'hsl(114, 44%, 50%)',
          700: 'hsl(114, 44%, 40%)',
        },
        yandex: {
          600: 'hsl(0, 100%, 50%)',
          700: 'hsl(0, 100%, 40%)',
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
    textColor: ['responsive', 'hover', 'focus', 'group-hover'],
    textDecoration: ['responsive', 'hover', 'focus', 'group-hover'],
  },
  plugins: [
    // eslint-disable-next-line global-require
    require('@tailwindcss/ui'),
  ],
}
